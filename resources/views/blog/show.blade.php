@extends('layout.app')

@section('content')
    <h1>{{ $post->title }}</h1>

    <p>Wrote {{ $post->created_at->diffForHumans() }}</p>

    <p>{{ $post->user->name }}</p>

    <p>{!! $post->content !!}</p>
@endsection
