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
        'name','category_id'
    ];

    /**
     * get the sub and the cat
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Categories', 'id', 'category_id');
    }

    /**
     * The table associated with the model.
     *
     * @var array
     */
    protected $table = 'subcategories';
}
