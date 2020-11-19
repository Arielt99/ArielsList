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
        if(Auth::id()){
            $posts = Post::whereDoesntHave('masked', function ($query) {
                return $query->where('user_id', Auth::id());
            })->where('title','like', '%'.$search_content.'%')->where('isActive',true)->with('subcategory','category','city', 'user')->orderBy('created_at','DESC')->get();
        }else{
            $posts = Post::where('title','like', '%'.$search_content.'%')->where('isActive',true)->with('subcategory','category','city', 'user')->orderBy('created_at','DESC')->get();
        }

        return Inertia::render('Display', [
            'posts' => $posts,
            'search_content' =>$search_content,
            'route_name' => 'search'
        ]);
    }
}
