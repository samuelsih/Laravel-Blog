<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\User;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

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
        return view('dashboard.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->title, $request->slug, $request->categories, $request->description);
        $post = $request->only(['title', 'slug', 'description', 'content']);
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
