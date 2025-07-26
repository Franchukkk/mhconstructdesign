@extends('layouts.app')

@section('content')
    <div class="wrapper blog article">
        <h1>{{ $post->title }}</h1>
        <article class="blog-article">
            {!! $post->body !!}
        </article>
    </div>
@endsection