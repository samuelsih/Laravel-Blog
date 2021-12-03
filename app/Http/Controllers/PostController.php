<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    //method index memunculkan semua post yang ada di blog
    //$post mencari semua post, dengan kategori yang dia punya
    public function index()
    {
        $posts = Post::with('categories')->get();

        return view('posts.index', compact('posts'));
        // dd('In index');
    }

    //method show mencari slug yang sama dengan parameter dan memunculkan tabel post dan category
    public function show($slug)
    {
        $post = Post::with('categories')
        ->where('slug', $slug)
        ->get();

        return view('posts.show', compact('post'));
    }
}
