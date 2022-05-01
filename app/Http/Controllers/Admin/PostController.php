<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.admin.post.index', [
            'posts' => Post::with('category')->latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.post.create', [
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $data = $request->except('tag');

        $imageName = md5($request->thumbnail).'.'.$request->thumbnail->extension();
        $request->thumbnail->storeAs('public/thumbnail', $imageName);

        $data['thumbnail'] = $imageName;
        $data['slug'] = Str::slug($request->title);
        $post = Post::create($data);

        $tags = explode(',', $request->tag);
        foreach ($tags as $tag) {
            $store = Tag::firstOrCreate(['name' => $tag]);
            $post->tag()->attach($store);
        }

        return redirect()->route('post.index')->with('success', 'New Post Created Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {   
        return view('pages.admin.post.edit', [
            'categories' => Category::all(),
            'post' => $post->load(['category','tag'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        $post->title = $request->title;
        $post->slug = Str::slug($request->title);
        $post->category_id = $request->category_id;
        $post->content = $post->content;

        if ($request->thumbnail) {
            Storage::delete('public/thumbnail/'.$post->thumbnail);
            $imageName = md5($request->thumbnail).'.'.$request->thumbnail->extension();
            $request->thumbnail->storeAs('public/thumbnail', $imageName);
            $post->thumbnail = $imageName;
        }

        $tags = explode(',', $request->tag);
        $tagArr = [];
        foreach ($tags as $tag) {
            $store = Tag::firstOrCreate(['name' => $tag]);
            $tagArr[] = $store->id;
        }

        $post->tag()->sync($tagArr);
        $post->save();

        return redirect()->route('post.index')->with('success', 'New Post Updated Successfully');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        Storage::delete('public/thumbnail/'.$post->thumbnail);
        return redirect()->route('post.index')->with('success', 'New Post Deleted Successfully');
    }
}
