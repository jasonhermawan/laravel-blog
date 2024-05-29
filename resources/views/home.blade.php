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
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="{{ $blog->title }}" width="100%"
                                height="225">
                            <div class="card-body">
                                <div class="mb-2">
                                    @if ($blog->author->avatar)
                                        <img src="{{ asset('storage/' . $blog->author->avatar) }}" alt="avatar"
                                            width="25" height="25" class="rounded-circle" style="object-fit: cover">
                                        <small>by {{ $blog->author->name }}</small>
                                    @else
                                        <div class="d-flex gap-1 align-items-center">
                                            <div class="rounded-circle"
                                                style="width: 25px; height: 25px; background-color: #adb5bd; color: #fff; display: flex; justify-content: center; align-items: center; text-transform: uppercase;">
                                                {{ substr($blog->author->name, 0, 1) }}
                                            </div>
                                            <small>by {{ $blog->author->name }}</small>
                                        </div>
                                    @endif
                                </div>
                                <h4 class="card-title"
                                    style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; margin-bottom: 10px;">
                                    {{ $blog->title }}</h4>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a style="font-size: 14px" href="{{ 'blog/' . $blog->id }}">Read more</a>
                                    <small class="text-body-secondary">{{ $blog->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
