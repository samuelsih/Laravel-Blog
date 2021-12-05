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
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //jika tidak ada satupun kategori yang di ceklis, redirect dan beri pesan error
        if(!$request->filled('name')){
            return redirect()->route('posts.create', [Auth::user()->username])->with('error', 'Error. Please check at least 1 category');
        }

        $categories = $request->name;
        $categoriesID = [];

        //cek apakah nama kategori yang di request ada di database
        foreach($categories as $category) {
            $query = Category::where('name', $category)->value('id');

            //jika ada nama yang tidak sesuai, kembalikan ke halaman semula
            if(!$query) {
                return redirect()->route('posts.create', [Auth::user()->username])->with('error', 'Error. Please check your category');
            }

            //jika ada, simpan ID dari setiap kategori kedalam array
            else {
                array_push($categoriesID, $query);
            }
        }

        // dd($categoriesID);
        $userID = Auth::user()->id;
        $checkPost = $request->only(['title', 'slug', 'description', 'content']);
        // $insertPost = Post::create($checkPost);

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

    public function makeSlug(Request $request)
    {
        //buat slug dari title nya
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);

        return response()->json([
            'slug' => $slug,
        ]);
    }
}
