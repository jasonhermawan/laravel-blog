<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('author')->orderBy('created_at', 'asc')->get();

        return view('home', compact('blogs'));
    }

    public function detail($slug, $id)
    {
        $blog = Blog::with('author')->findOrFail($id);

        return view('blog', compact('blog'));
    }

    public function store(Request $request)
    {
        $authorId = Auth::id();

        $validatedData = $request->validate([
            'thumbnail' => 'required',
            'title' => 'required',
            'content' => 'required',
        ]);

        $validatedData['thumbnail'] = $request->file('thumbnail')->store('thumbnails');

        Blog::create(array_merge(
            $validatedData,
            ['author_id' => $authorId]
        ));

        return redirect()->route('dashboard');
    }
}
