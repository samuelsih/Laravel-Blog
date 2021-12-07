<?php

namespace App\Http\Controllers;

use App\Models\Category;
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
            $posts = Post::with(['category', 'user'])->where('title', 'like', '%'.request('search').'%')->paginate(12);
        }

        //jika ada orang yang click tags category, $post nya ini
        else if(request('category')) {
            if(request('category') == 'All') {
                $posts = Post::with(['category', 'user'])->latest()->paginate(12);
            }

            else {
                $req = request('category');
                $categoryID = Category::where('name', $req)->value('id');

                // dd($req, $categoryID);

                if(!$categoryID) {
                    return redirect()->route('blog.index')->with('error', 'Category not found.');
                }

                $posts = Post::with(['category', 'user'])->where('category_id', $categoryID)->paginate(12);
            }
        }

        else {
            //pakai with method untuk menghindari N + 1
            $posts = Post::with(['category', 'user'])->latest()->paginate(12);
        }

        $categories = Category::all();
        return view('blog.index', compact('posts', 'categories'));
        // dd('In index');
    }

    //method show mencari slug yang sama dengan parameter dan memunculkan tabel post dan category
    public function show($slug)
    {
        //pakai with method untuk menghindari N + 1
        $post = Post::where('slug', $slug)->firstOrFail();

        $categories = Category::all();

        return view('blog.show', compact('post', 'categories'));
    }
}
