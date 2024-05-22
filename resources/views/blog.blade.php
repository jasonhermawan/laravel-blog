@extends('layouts.app')

@section('content')
    <h1>{{ $blog->title }}</h1>
    <p>Written by {{ $blog->author->name }}</p>
    <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="{{ $blog->title }}" width="100%" height="500"
        style="object-fit: cover">
    <div class="mt-5">
        {!! $blog->content !!}
    </div>
@endsection
