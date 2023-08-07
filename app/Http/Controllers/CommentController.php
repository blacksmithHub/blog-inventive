<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Notifications\CommentNotification;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'user_id' => $request->user()->id
        ]);

        $request = $this->validate($request, [
            'user_id' => [
                'required',
                'numeric',
                Rule::exists('users', 'id')
            ],
            'post_id' => [
                'required',
                'numeric',
                Rule::exists('posts', 'id')
            ],
            'comment' => [
                'required',
                'string'
            ]
        ]);

        $comment = Comment::create($request);

        $author = $comment->post->user;

        $author->notify(new CommentNotification($comment->post_id));

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Comment::find($id)->delete();

        return redirect()->back();
    }
}
