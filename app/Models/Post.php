<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'description',
        'state',
        'user_id',
        'city_slug',
        'category_slug',
        'subcategory_slug'
    ];

    /**
     * get the user
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id');
    }

    /**
     * get the city
     */
    public function city()
    {
        return $this->belongsTo('App\Models\Cities','city_slug','slug');
    }

    /**
     * get the category
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Categories','category_slug','slug');
    }

    /**
     * get the subcategory
     */
    public function subcategory()
    {
        return $this->belongsTo('App\Models\SubCategories','subcategory_slug','slug');
    }

    /**
     * The table associated with the model.
     *
     * @var array
     */
    protected $table = 'posts';
}
