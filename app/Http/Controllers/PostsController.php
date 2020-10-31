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
    public function show($city_slug, $category_slug, $subcategory_slug, $post_slug)
    {
        $post = Post::where('slug',$post_slug)->where('city_slug', $city_slug)->where('category_slug', $category_slug)->where('subcategory_slug', $subcategory_slug)->with('subcategory','category','city','user')->first();

        if($post->user_id == Auth::id()){
            return Inertia::render('Posts', [
                'post' => $post,
            ]);
        }elseif($post->isActive==true){
            return Inertia::render('Posts', [
                'post' => $post,
            ]);
        }


    }

    public function show_current()
    {
        $posts = Post::where('user_id', Auth::id())->with('subcategory','category','city', 'user')->get();


        return Inertia::render('PostManagement/UserDisplay', [
            'posts' => $posts,
            'route_name' => 'userPosts'
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
            'isActive'=> ['required', 'boolean']
        ])->validateWithBag('addPost');

        $city = Cities::where('id',$request->city)->first();

        $subcategory = SubCategories::where('id',$request->subcategory)->first();
        $category = Categories::where('slug',$subcategory->category_slug)->first();

        $post = new Post();
        $post->title = $request->title;
        $post->isActive = $request->isActive;
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

    public function updateShow($post_slug){

        $post = Post::where('slug',$post_slug)->with('subcategory','category','city', 'user')->first();

        $cities = Cities::all();
        $categories = Categories::with('subcategories')->get();

        return Inertia::render('PostManagement/ModifyPost', [
            'post' => $post,
            'cities' => $cities,
            'categories' => $categories
        ]);
    }

    public function update($post_slug, Request $request){

        Validator::make($request->all(), [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required','string'],
            'city' => ['required'],
            'subcategory'=> ['required'],
            'isActive'=> ['required', 'boolean']
        ])->validateWithBag('modifyPost');

        $post = Post::where('slug',$post_slug)->with('subcategory','category','city', 'user')->first();

        $city = Cities::where('id', $request['city'])->first();

        $subcategory = SubCategories::where('id', $request['subcategory'])->first();
        $category = Categories::where('slug',$subcategory->category_slug)->first();

        $post->forceFill([
            'title' => $request['title'],
            'description' => $request['description'],
            'city_slug' => $city->slug,
            'category_slug' => $category->slug,
            'subcategory_slug' => $subcategory->slug,
            'isActive' => $request['isActive'],
        ])->save();

        return $request->wantsJson()
        ? new JsonResponse('', 200)
        : back()->with('status', 'post added');
    }



    public function destroy(Request $request){
        Validator::make($request->all(), [
            'target_post' => ['required'],
        ])->validateWithBag('deletePost');

        if(Auth::id() == $request->target_post['user_id']){
            Post::findOrFail($request->target_post['id'])->delete();
            return $request->wantsJson()
            ? new JsonResponse('', 200)
            : back()->with('status', 'post deleted');
        }
    }
}
