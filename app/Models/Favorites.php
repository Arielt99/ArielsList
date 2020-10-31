<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'post_slug',
    ];

    /**
     * Get the post.
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User','user_id','id');
    }

    /**
     * Get the post.
     */
    public function post()
    {
        return $this->hasMany('App\Models\Post','slug', 'post_slug');
    }

    /**
     * The table associated with the model.
     *
     * @var array
     */
    protected $table = 'favorite';
}
