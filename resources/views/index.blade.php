@extends('layout.app')

@section('content')
    @foreach ($posts as $post)
        <tr>
            <td> Post -> title :  {{ $post->title }}</td>
            <td> Post -> slug {{ $post->slug }}</td>
            <td>
                <ul>
                    @foreach ($post->categories as $category)
                        <li>{{ $category->name }}</li>
                    @endforeach
                </ul>
            </td>
        </tr>
    @endforeach

@endsection

