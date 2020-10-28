<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function display($search_content)
    {
        $posts = Post::where('title','like', '%'.$search_content.'%')->get();
        return Inertia::render('Display', [
            'posts' => $posts,
            'search_content' =>$search_content,
        ]);
    }
}
