<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'category_slug'
    ];

    /**
     * get the parent category
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Categories', 'slug', 'category_slug');
    }

    /**
     * The table associated with the model.
     *
     * @var array
     */
    protected $table = 'subcategories';
}
