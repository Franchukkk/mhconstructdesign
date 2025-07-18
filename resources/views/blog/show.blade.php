@extends('layouts.app')

@section('content')
  <h1>{{ $post->title }}</h1>
  @if($post->image)
    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
  @endif

  <article>
    {!! nl2br(e($post->body)) !!}
  </article>
@endsection
