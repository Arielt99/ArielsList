<?php

namespace App\Http\Controllers;

use App\Models\Favorites;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class FavoritesController extends Controller
{

    public function display()
    {
        $posts = Post::whereHas('favorite', function ($query) {
            return $query->where('user_id', Auth::id());
        })->with('subcategory','category','city', 'user')->get();
        return Inertia::render('Display', [
            'posts' => $posts,
            'route_name' => 'favorite'
        ]);
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'post_slug' => ['required','string'],
        ])->validateWithBag('addFavorite');

        $exist= Favorites::where('user_id', Auth::id())->where('post_slug', $request->post_slug)->first();

        if(!$exist){
            $fav = new Favorites();
            $fav->user_id = Auth::id();
            $fav->post_slug = $request->post_slug;
            $fav->save();

            return $request->wantsJson()
            ? new JsonResponse('', 200)
            : back()->with('status', 'fav added');
        }else{
            $exist->delete();
            return $request->wantsJson()
            ? new JsonResponse('', 200)
            : back()->with('status', 'fav deleted');
        }

    }
}
