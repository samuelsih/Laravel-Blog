@extends('layout.dashboard')

@section('name', $user->username)

@section('content')
<ul>
    @foreach($user->posts as $post)
        <li>{{ $post->title }}</li>
        <li>{{ $post->description }}</li>
        <li>{{ $post->content }}</li>
    @endforeach
</ul>

@endsection
