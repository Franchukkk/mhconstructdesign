@extends('layouts.app')

@section('content')
    <div class="wrapper blog article">
        <article class="blog-article">
            <h1>{{ $post->title }}</h1>
            {!! $post->body !!}
        </article>
    </div>
@endsection