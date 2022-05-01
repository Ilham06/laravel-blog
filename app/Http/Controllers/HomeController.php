<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('welcome', [
            'posts' => Post::with('category')->latest()->paginate(5)
        ]);
    }

    public function show(Post $post)
    {
        return view('detail', [
            'post' => $post
        ]);
    }
}
