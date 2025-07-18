@extends('admin.layout')

@section('content')
    <h1>Створити нову статтю</h1>

    <form action="{{ route('admin.blog.store') }}" enctype="multipart/form-data" method="POST">
        @include('admin.blog.form')
    </form>
@endsection
