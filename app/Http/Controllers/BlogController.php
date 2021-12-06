<?php

namespace App\Http\Controllers;


use App\Models\Post;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    //method index memunculkan semua post yang ada di blog
    //$post mencari semua post, dengan kategori yang dia punya
    public function index()
    {
        //jika ada pencarian di navbar, return $posts yang ini
        if(request('search')) {
            //%title%
            $posts = Post::with('category')->where('title', 'like', '%'.request('search').'%')->paginate(10);
        }

        else {
            //pakai with method untuk menghindari N + 1
            $posts = Post::with('category')->latest()->paginate(10);
        }


        return view('blog.index', compact('posts'));
        // dd('In index');
    }

    //method show mencari slug yang sama dengan parameter dan memunculkan tabel post dan category
    public function show($slug)
    {
        //pakai with method untuk menghindari N + 1
        $post = Post::where('slug', $slug)->firstOrFail();

        return view('blog.show', compact('post'));
    }
}
