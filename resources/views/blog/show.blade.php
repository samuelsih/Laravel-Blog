@extends('layout.app')

@section('content')
    @foreach ($post as $p)
        <h1>{{ $p->title }}</h1>

            @foreach ($p->categories as $category)
                <p>{{ $category->name }}</p>
            @endforeach

        <p>{{ $p->content }}</p>

    @endforeach

@endsection
