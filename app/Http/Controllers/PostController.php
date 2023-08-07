<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\EditRequest;
use App\Models\Post;
use Facades\App\Repositories\Contracts\PostRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('post', [
            'only' => ['update', 'destroy']
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = PostRepositoryInterface::index();

        return view('dashboard')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Auth::user()->id 
        // auth()->user()->id // 
        $request->merge([
            'user_id' => $request->user()->id
        ]);

        $request = $this->validate($request, [
            'user_id' => [
                'required',
                Rule::exists('users', 'id') // 'exists:users,id'
            ],
            'title' => 'required',
            'body' => 'required'
        ]);

        Post::create($request);

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // $post = Post::with(['user'])->find($id);
        // Post::where('id', $id)->first();

        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EditRequest $request, Post $post)
    {
        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request = $this->validate($request, [
            'title' => 'required',
            'body' => 'required'
        ]);

        Post::where('id', $id)->update($request);

        return redirect()->route('posts.show', $id);

        // $post = Post::find($id);
        // $post->title = $request['title'];
        // $post->body = $request['body'];
        // $post->update();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Post::find($id)->delete();

        // $post->delete();

        return redirect()->route('dashboard');

        // $post = Post::where('id', $id)->first();
        // $post->delete();
    }
}
