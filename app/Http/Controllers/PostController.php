<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;

// use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $title = '';
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            $title = ' in ' . $category->name;
        }

        if (request('author')) {
            $author = User::firstWhere('username', request('author'));
            $title = ' by ' . $author->name;
        }

        return view('posts.index', [
            // 'posts' => Post::all(),
            // 'posts' => Post::with(['category', 'author'])->latest()->get(),
            'posts' => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString(),
            'title' => 'All Posts' . $title,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // dd($post);
        return view('posts.show', [
            'post' => $post,
            'title' => 'Post Detail'
        ]);
    }
}
