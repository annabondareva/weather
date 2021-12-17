<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Category
 * @package App\Models
 *
 * @property int id
 * @property string title
 */
final class Category extends Model
{
    protected $table = 'category';
    protected $fillable = [
        'id',
        'title',
    ];

    public function event(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
