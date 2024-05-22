@extends('layouts.app')

@section('content')
    {{-- Feeds --}}
    <div class="album py-5 bg-body-tertiary">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                @if (count($blogs) < 1)
                    <div class="m-auto">
                        <h4 class="text-center">No blogs found...</h4>
                    </div>
                @endif

                @foreach ($blogs as $blog)
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="{{ $blog->title }}" width="100%"
                                height="225">
                            <div class="card-body">
                                <h4 class="card-title">{{ $blog->title }}</h4>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a style="font-size: 14px" href="{{ $blog->title . '/' . $blog->id }}">Read more</a>
                                    <small class="text-body-secondary">By {{ $blog->author->name }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
