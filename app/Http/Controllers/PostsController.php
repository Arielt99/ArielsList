<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Inertia\Inertia;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function show($post_slug)
    {
        $post = Post::where('slug','like', '%'.$post_slug.'%')->with('subcategory','category','city', 'user')->first();

        return Inertia::render('Posts', [
            'post' => $post,
        ]);
    }
}
