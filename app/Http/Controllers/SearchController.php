<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SearchController extends Controller
{
    public function display($search_content)
    {
        $posts = Post::where('title','like', '%'.$search_content.'%')->where('isActive',true)->with('subcategory','category','city', 'user')->get();
        return Inertia::render('Display', [
            'posts' => $posts,
            'search_content' =>$search_content,
            'route_name' => 'search'
        ]);
    }
}
