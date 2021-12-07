@extends('layout.dashboard')

{{-- karna ada stack di dashboard layout, kita push apa yang kita mau di section trix-editor --}}
@push('trix-editor-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/trix.css') }}">
    <script type="text/javascript" src="{{ asset('js/trix.js') }}"></script>
@endpush

@section('content')
    <div class="text my-3 border-bottom">
        <h2>@yield('method') a New Post</h2>
    </div>

    @if($message = Session::get('error'))
        <div class="alert alert-danger my-2">{{ $message }}</div>
    @endif

    @yield('form')


@endsection
