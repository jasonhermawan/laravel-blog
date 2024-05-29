@extends('layouts.app')

@section('content')
    <div class="d-flex gap-5">

        {{-- Main Blog --}}
        <div class="w-75">
            {{-- Blog Content --}}
            <div>
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h1>{{ $blog->title }}</h1>
                <div class="d-flex align-items-center gap-2 mb-4">
                    @if ($blog->author->avatar)
                        <img src="{{ asset('storage/' . $blog->author->avatar) }}" alt="avatar" width="32" height="32"
                            class="rounded-circle" style="object-fit: cover">
                    @else
                        <div class="rounded-circle"
                            style="width: 32px; height: 32px; background-color: #adb5bd; color: #fff; display: flex; justify-content: center; align-items: center; text-transform: uppercase;">
                            {{ substr($blog->author->name, 0, 1) }}
                        </div>
                    @endif
                    <small>Written by {{ $blog->author->name }} - {{ $blog->created_at->diffForHumans() }}</small>
                </div>
                <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="{{ $blog->title }}" width="100%"
                    height="500" style="object-fit: cover; border-radius: 10px">
                <div class="mt-5">
                    {!! $blog->content !!}
                </div>
            </div>

            {{-- Comment Section --}}
            <div>

                {{-- Comment Form --}}
                <form action="{{ route('comment.post', $blog->id) }}" method="POST">
                    @csrf
                    <div class="d-flex align-items-center gap-2 mt-5">
                        {{-- User loggedin --}}
                        @auth
                            @if (Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="avatar" width="32"
                                    height="32" class="rounded-circle" style="object-fit: cover">
                                <div class="w-100">
                                    <input type="text" name="comment" class="form-control" placeholder="Add your comment"
                                        value="{{ old('comment') }}">
                                </div>
                                <button class="btn btn-primary" name="submit" type="submit">Submit</button>
                            @else
                                <div class="rounded-circle"
                                    style="width: 32px; height: 32px; background-color: #adb5bd; color: #fff; display: flex; justify-content: center; align-items: center; text-transform: uppercase;">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div class="w-100">
                                    <input type="text" name="comment" class="form-control" placeholder="Add your comment"
                                        value="{{ old('comment') }}">
                                </div>
                                <button class="btn btn-primary" name="submit" type="submit">Submit</button>
                            @endif
                        @endauth
                        {{-- User not loggedin --}}
                        @guest
                            <div class="w-100">
                                <input type="text" name="comment" class="form-control" placeholder="Login to comment"
                                    disabled value="{{ old('comment') }}">
                            </div>
                            <button class="btn btn-primary" name="submit" disabled>Submit</button>
                        @endguest
                    </div>
                </form>

                {{-- Comments --}}
                <div class="mt-5">
                    @if (count($comments) < 1)
                        <div class="m-auto">
                            <h5 class="text-center">No comments yet...</h5>
                        </div>
                    @endif

                    @foreach ($comments as $comment)
                        <div class="d-flex align-items-start justify-content-between">
                            <div class="d-flex alig-items-start gap-3">
                                @if ($comment->user->avatar)
                                    <img src="{{ asset('storage/' . $comment->user->avatar) }}" alt="avatar"
                                        width="32" height="32" class="rounded-circle" style="object-fit: cover">
                                @else
                                    <div class="rounded-circle"
                                        style="width: 32px; height: 32px; background-color: #adb5bd; color: #fff; display: flex; justify-content: center; align-items: center; text-transform: uppercase;">
                                        {{ substr($comment->user->name, 0, 1) }}
                                    </div>
                                @endif
                                <div>
                                    <h6>{{ $comment->user->name }} -
                                        <small>{{ $comment->created_at->diffForHumans() }}</small>
                                    </h6>
                                    <p>{{ $comment->comment }}</p>
                                </div>
                            </div>
                            @auth
                                @if ($comment->user->id === Auth::user()->id)
                                    <form action="{{ route('comment.delete', ['id' => $comment->id]) }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <div>
                                            <button name class="btn btn-danger" type="submit">X</button>
                                        </div>
                                    </form>
                                @endif
                            @endauth
                        </div>
                        @if (!$loop->last)
                            {{-- Check if it's not the last comment --}}
                            <div class="border-top pb-3"></div> {{-- Add a divider --}}
                        @endif
                    @endforeach
                </div>

            </div>

        </div>

        {{-- Other Blogs --}}
        <div class="w-25">
            <div class="p-4" style="position: sticky; top: 20px; background-color: #fbfbfb; border-radius: 10px;">
                @foreach ($blogs as $blog)
                    <div class="mb-4">
                        <h5>{{ $blog->title }}</h5>
                        <a style="font-size: 14px" href="{{ $blog->id }}">Read more</a>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endsection
