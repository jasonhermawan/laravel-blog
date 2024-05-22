@extends('layouts.dashboard')

@section('content')
    <div>
        <h3>Create New Blog</h3>
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
            <form class="w-100" action="{{ route('dashboard.post') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="d-flex gap-4">
                    <div class="w-100">
                        <div class="mb-3">
                            <input type="text" name="title" class="form-control" placeholder="Enter blog title here">
                        </div>
                        <div class="mb-3">
                            <input type="file" name="thumbnail" class="form-control">
                        </div>
                        <div class="mb-3">
                            <textarea name="content" id="editor" cols="30" rows="10"></textarea>
                        </div>
                        <div class="d-flex gap-2 justify-content-end">
                            <button name="submit" type="submit" class="btn btn-primary">Publish Blog</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
