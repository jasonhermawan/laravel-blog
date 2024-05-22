<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $blogs = Blog::with('author')->where('author_id', $userId)->orderBy('created_at', 'desc')->get();

        return view('dashboard.list', compact('blogs'));
    }

    public function create()
    {
        return view('dashboard.index');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->author_id !== Auth::id()) {
            abort(403);
        }

        return view('dashboard.index', compact('blog'));
    }
}
