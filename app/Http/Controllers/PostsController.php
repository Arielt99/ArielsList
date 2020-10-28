<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Cities;
use App\Models\Post;
use App\Models\SubCategories;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    public function show($post_slug)
    {
        $post = Post::where('slug','like', '%'.$post_slug.'%')->with('subcategory','category','city', 'user')->first();

        return Inertia::render('Posts', [
            'post' => $post,
        ]);
    }

    public function addShow()
    {
        $cities = Cities::all();
        $categories = Categories::with('subcategories')->get();

        return Inertia::render('PostManagement/AddPost', [
            'cities' => $cities,
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required','string'],
            'city' => ['required'],
            'subcategory'=> ['required'],
        ])->validateWithBag('addPost');

        $city = Cities::where('id',$request->city)->first();

        $subcategory = SubCategories::where('id',$request->subcategory)->first();
        $category = Categories::where('slug',$subcategory->category_slug)->first();

        $post = new Post();
        $post->title = $request->title;
        $post->slug = Str::slug(rand() . $request->title);
        $post->description = $request->description;
        $post->city_slug = $city->slug;
        $post->category_slug = $category->slug;
        $post->subcategory_slug = $subcategory->slug;
        $post->user_id = Auth::id();
        $post->save();

        return $request->wantsJson()
        ? new JsonResponse('', 200)
        : back()->with('status', 'post added');
    }

}
