<?php

namespace App\Http\Controllers;

use App\Models\Masked;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Inertia\Inertia;

class MaskedController extends Controller
{
    public function display()
    {
        $posts = Post::whereHas('masked', function ($query) {
            return $query->where('user_id', Auth::id());
        })->with('subcategory','category','city', 'user')->orderBy('created_at','DESC')->get();
        return Inertia::render('Display', [
            'posts' => $posts,
            'route_name' => 'masked'
        ]);
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'post_slug' => ['required','string'],
        ])->validateWithBag('addMasked');

        $exist= Masked::where('user_id', Auth::id())->where('post_slug', $request->post_slug)->first();

        if(!$exist){
            $fav = new Masked();
            $fav->user_id = Auth::id();
            $fav->post_slug = $request->post_slug;
            $fav->save();

            return $request->wantsJson()
            ? new JsonResponse('', 200)
            : back()->with('status', 'Masked added');
        }else{
            $exist->delete();
            return $request->wantsJson()
            ? new JsonResponse('', 200)
            : back()->with('status', 'Masked deleted');
        }

    }
}
