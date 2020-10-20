<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Get the category that owns the subcategory.
     */
    public function subcategories()
    {
        return $this->hasMany('App\Models\SubCategories','category_id');
    }

    /**
     * The table associated with the model.
     *
     * @var array
     */
    protected $table = 'categories';
}
