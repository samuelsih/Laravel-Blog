<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth', 'isValidUsername']);
    }

    public function index($username)
    {
        // if(Auth::user()->username !== $username) {
        //     return redirect('blog')->with('error', 'Error occured. Please try again');
        // }

        //jangan lupa category nya punya potensi N+1 lur.
        $posts = Post::with(['user', 'category'])->where('user_id', Auth::user()->id)->get();
        return view('dashboard.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($username)
    {
        $user = User::with(['posts'])->where('username', $username)->latest()->firstOrFail();
        $categories = Category::all();
        return view('dashboard.create', [
            'user' => $user,
            'categories' => $categories,
            'method' => 'Create',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($username, Request $request)
    {
        $categoryID = Category::where('name', $request->category)->value('id');
        $userID = User::where('username', $username)->value('id');

        if(!$categoryID) {
            return redirect()->route('posts.create')->withErrors('Error on categories');
        }

        //validasi tanpa requests controller karena kita butuh id dari kategori nya
        $post = $request->validate([
            'title' => ['required', 'min:10', 'max:80'],
            'slug' => ['required', 'unique:posts', 'min:5', 'max:40'],
            'description' => ['required', 'max:100'],
            'content' => ['required', 'max:1000'],
            'image' => ['image', 'max:2048'],
        ]);

        $post['user_id'] = $userID;
        $post['category_id'] = $categoryID;

        //store gambar jika ada
        if($request->file('image')) {
            $post['image'] = $request->file('image')->store('storage');
        }

        $dd = Post::create($post);

        return redirect()->route('posts.index', ['username' => $username])->withSuccess('Success!!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function show($username)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $username)
    {
        $userID = User::where('username', $username)->value('id');
        $slug = $request->post;

        $post = Post::with(['category', 'user'])
                ->where('slug', $slug)
                ->where('user_id', $userID)
                ->first();

        $categories = Category::all();

        return view('dashboard.update', [
            'post' => $post,
            'categories' => $categories,
            'method' => 'Update',
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $username)
    {
        dd($request('image'));
        $categoryID = Category::where('name', $request->category)->value('id');
        $userID = User::where('username', $username)->value('id');

        if(!$categoryID) {
            return redirect()->route('posts.create')->withErrors('Error on categories');
        }

        //validasi tanpa request karena kita butuh id dari kategori nya
        $post = $request->validate([
            'title' => ['required', 'min:10', 'max:80'],
            'slug' => ['required', 'min:5', 'max:30'],
            'description' => ['required', 'max:100'],
            'content' => ['required', 'max:1000'],
            'image' => ['image', 'max:2048'],
        ]);

        //store gambar jika ada
        if($request->hasFile('image')) {
            $post['image'] = $request->file('image')->store('thumbnail-images');
        }

        Post::where('slug', $request->slug)->update($post);

        return redirect()->route('posts.index', ['username' => $username])->withSuccess('Edit Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function destroy($username, $slug)
    {
        $deletePost = Post::where('slug', $slug)->delete();

        if($deletePost) {
            return redirect()->route('posts.index', ['username' => $username])->withSuccess('Delete Success.');
        }

        return redirect()->route('posts.index', ['username' => $username])->withErrors('Delete Failed.');
    }
}
