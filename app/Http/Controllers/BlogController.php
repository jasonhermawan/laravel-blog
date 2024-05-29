<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('author')->orderBy('created_at', 'asc')->get();

        return view('home', compact('blogs'));
    }

    public function detail($id)
    {
        $blog = Blog::with('author')->findOrFail($id);
        $blogs = Blog::with('author')->whereNotIn('id', [$id])->get();
        $comments = Comment::with('user')->where('blog_id', $id)->get();

        return view('blog', compact('blog', 'blogs', 'comments'));
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

        return redirect()->route('dashboard.list')->with('success', 'Blog created');
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $validatedData = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        if ($request->hasFile('thumbnail')) {
            $validatedData['thumbnail'] = $request->file('thumbnail')->store('thumbnails');
            Storage::delete($blog->thumbnail);
        }

        $blog->update($validatedData);

        return redirect()->route('dashboard.list')->with('success', 'Blog updated');
    }

    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);

        Storage::delete($blog->thumbnail);

        $blog->delete();

        return redirect()->route('dashboard.list')->with('success', 'Blog deleted');
    }
}
