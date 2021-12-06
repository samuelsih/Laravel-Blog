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

        $user = User::with(['posts'])->where('username', $username)->latest()->firstOrFail();
        return view('dashboard.index', compact('user'));
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



        //validasi tanpa request karena kita butuh id dari kategori nya
        $validated = $request->validate([
            'title' => ['required', 'min:5', 'max:30'],
            'slug' => ['required', 'min:5', 'max:30'],
            'description' => ['required', 'min:10', 'max:50'],
            'content' => ['required', 'min:50', 'max:500'],
        ]);

        Post::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'description' => $request->description,
            'content' => $request->content,
            'category_id' => $categoryID,
            'user_id' => $userID,
        ]);

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
    public function edit($username)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $username
     * @return \Illuminate\Http\Response
     */
    public function destroy($username)
    {
        //
    }
}
