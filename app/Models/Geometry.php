<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Geometry
 * @package App\Models
 *
 * @property int id
 * @property string event_id
 * @property string date_and_time
 * @property string coordinates
 *
 */
final class Geometry extends Model
{

    protected $table = 'geometry';

    protected $fillable = [
        'id',
        'event_id',
        'date_and_time',
        'coordinates'
    ];

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
