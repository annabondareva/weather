<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Geometry;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

/**
 * Class BroadcastController
 * @package App\Http\Controllers
 */
class BroadcastController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): view
    {
        $selectedCategories = $request->get('events') ?? $request->get('selectedCategories');

        $geometries = Geometry::query()
            ->with('event')
            ->when(
                $selectedCategories,
                function ($q) use ($selectedCategories) {
                    $filteredEventsId = Event::query()->whereIn('event.category_id', $selectedCategories)->pluck(
                        'id'
                    )->all();
                    /** @var Builder $q */
                    return $q->whereIn('event_id', $filteredEventsId);
                }
            )
            ->paginate($request->get('perPage'))
            ->appends(request()->input());

        return view('main', compact('geometries', 'selectedCategories'));
    }


}
