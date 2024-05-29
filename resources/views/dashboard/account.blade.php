@extends('layouts.dashboard')

@section('content')
    <h3>Account Settings</h3>
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
    <div class="mt-4">
        <form action="{{ route('account.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div>
                <div class="mb-3 w-50">
                    <label class="mb-2" for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Enter name here"
                        value="{{ $user->name }}">
                </div>
                <div class="mb-3 w-50">
                    <label class="mb-2" for="email">Email</label>
                    <input type="email" id="email" name='email' class="form-control" placeholder="Enter email here"
                        value="{{ $user->email }}">
                </div>
                <div class="mb-3 w-50">
                    <label class="mb-2" for="email">Avatar</label>
                    <input type="file" name="avatar" class="form-control" id="avatar_input">
                </div>
                <div class="w-50 d-flex justify-content-end">
                    <button name="submit" type="submit" class="btn btn-primary">Save Edit</button>
                </div>
            </div>
        </form>
    </div>
@endsection
