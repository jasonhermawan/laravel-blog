<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
    }

    public function store(Request $request, $blogId)
    {
        $userId = Auth::id();

        $validatedData = $request->validate([
            'comment' => 'required'
        ]);

        Comment::create(array_merge(
            $validatedData,
            ['user_id' => $userId, 'blog_id' => $blogId],
        ));

        return redirect()->route('blog', $blogId)->with('success', 'Comment created');
    }

    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);

        $comment->delete();

        return redirect()->route('blog', $comment->blog_id)->with('success', 'Comment deleted');
    }
}
