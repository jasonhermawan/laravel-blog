@extends('layouts.dashboard')

@section('content')
    <div>
        <h3>{{ isset($blog) ? 'Update Blog' : 'Create New Blog' }}</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="w-100 mt-4">
            <form class="w-100" action="{{ isset($blog) ? route('dashboard.update', $blog->id) : route('dashboard.post') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($blog))
                    @method('put')
                @endif
                <div class="d-flex gap-4">
                    <div class="w-100">
                        <div class="mb-3">
                            <input type="text" name="title" class="form-control" placeholder="Enter blog title here"
                                value="{{ isset($blog) ? $blog->title : old('title') }}">
                        </div>
                        <div class="mb-3">
                            <input type="file" name="thumbnail" class="form-control" id="thumbnail_input">
                        </div>
                        <div class="mb-3">
                            <textarea name="content" id="editor" cols="30" rows="10">{{ isset($blog) ? $blog->content : old('content') }}</textarea>
                        </div>
                        <div class="d-flex gap-2 justify-content-end">
                            <button name="submit" type="submit"
                                class="btn btn-primary">{{ isset($blog) ? 'Update Blog' : 'Publish Blog' }}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
