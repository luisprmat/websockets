<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('show');
    }

    public function show(Post $post)
    {
        $post->load('user');

        return view('posts.show', compact('post'));
    }
}
