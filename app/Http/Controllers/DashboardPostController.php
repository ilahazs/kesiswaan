<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = ((Auth::user()->role == 'admin') ? Post::orderBy('updated_at', 'desc')->get() : Post::where('user_id', Auth::user()->id)->get());

        /* Jika user yang login memiliki role admin -> tampilkan semua post no matter which user_id | Jika selain itu -> tampilkan post yang berkoresponding dengan user_id saja */

        // Cara Lain
        /* if (Auth::user()->role == 'admin') {
            $posts = Post::latest()->get();
        } else {
            $posts = Post::where('user_id', Auth::user()->id)->get();
        } */

        return view('dashboard.posts.index', [
            'title' => 'All Post',
            'posts' => $posts,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.posts.create', [
            'title' => 'Create Post',
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->file('image')->store('post-images');

        $validatedData = $request->validate([
            'title' => ['required', 'max:255'],
            'slug' => ['required', 'unique:posts'],
            'category_id' => ['required'],
            'image' => 'image|file|max:1024',
            'body' => ['required'],
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 150, ' ...');
        Post::create($validatedData);

        return redirect('/dashboard/posts')->with('success', 'New post has been <strong>added!</strong>');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */

    // Event

    public function show(Post $post)
    {
        return view('dashboard.posts.show', [
            'title' => 'Detail Post',
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('dashboard.posts.edit', [
            'title' => 'Edit Post',
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $rules = [
            'title' => ['required', 'max:255'],
            'category_id' => ['required'],
            'body' => ['required'],
            'image' => 'image|file|max:1024',
        ];

        // 'slug' => ['required', 'unique:posts'],
        if ($request->slug != $post->slug) {
            $rules['slug'] = 'required|unique:posts';
        }

        $validatedData = $request->validate($rules);
        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = Auth::user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 150, ' ...');
        Post::where('id', $post->id)->update($validatedData);

        $title = $post->title;

        return redirect('/dashboard/posts')->with('success', "Post: <strong>$title</strong> has been <strong>updated!</strong>");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        Post::destroy($post->id);
        if ($post->image) {
            Storage::delete($post->image);
        }
        $title = $post->title;
        return redirect('/dashboard/posts')->with('success', "Post: <strong>$title</strong> has been <strong>deleted!</strong>");
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
