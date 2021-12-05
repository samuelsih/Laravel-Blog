<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        $user = User::where('username', $username)->firstOrFail();
        return view('dashboard.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($username)
    {
        $user = User::where('username', $username)->value('name');
        return view('dashboard.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request->title, $request->slug, $request->categories);
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
