@extends('layouts.dashboard')

@section('content')
    <div>
        <h3>My Blogs</h3>

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

        @if (count($blogs) < 1)
            <div style="margin-top: 100px">
                <h5 class="text-center fw-regular">No blogs found...</h5>
            </div>
        @endif

        <div class="mt-4">
            @foreach ($blogs as $blog)
                <div class="p-4 d-flex align-items-center justify-content-between border mb-4" style="border-radius: 15px">
                    <div class="d-flex gap-4 align-items-center">
                        <div>
                            <img src="{{ asset('storage/' . $blog->thumbnail) }}" alt="{{ $blog->title }}" width="120px"
                                height="80px" style="object-fit: cover; border-radius: 10px">
                        </div>
                        <div>
                            <h5>{{ $blog->title }}</h5>
                            <p style="font-size: 14px">Published {{ $blog->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 align-items-center">
                        <form action="{{ route('blog.delete', ['id' => $blog->id]) }}" method="POST">
                            @csrf
                            @method('delete')
                            <button name="delete" class="btn btn-danger" type="submit">Delete</button>
                        </form>
                        <a href="{{ route('dashboard.edit', ['id' => $blog->id]) }}" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
