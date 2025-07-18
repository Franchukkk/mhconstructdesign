@extends('admin.layout')

@section('content')
    <h1>Редагувати статтю</h1>

    <form action="{{ route('admin.blog.update', $post) }}" method="POST">
        @method('PUT')
        @include('admin.blog.form')
    </form>
@endsection
