<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Event
 * @package App\Models
 *
 * @property string id
 * @property string title
 * @property integer category_id
 */
class Event extends Model
{
    protected $table = 'event';

    protected $fillable = [
        'id',
        'title',
        'category_id'
    ];

    protected $casts = ['id' => 'string'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function geometry(): HasMany
    {
        return $this->hasMany(Geometry::class);
    }
}
