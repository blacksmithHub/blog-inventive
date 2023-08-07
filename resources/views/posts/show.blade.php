<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Show Post') }}
        </h2>
    </x-slot>

    <a href="{{ route('dashboard') }}">Back</a>

    @if (auth()->user()->id === $post->user_id)
        <x-nav-link href="{{ route('posts.edit', $post->id) }}">
            Edit Post
        </x-nav-link>

        <form action="{{ route('posts.destroy', $post->id) }}" method="post">
            @csrf
            @method('DELETE')
            
            <button>Delete Post</button>
        </form>
    @endif

    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ $post->title }}
    </h2>

    <p class="postBody">
        {{ $post->body }}
    </p>

    <p>
       Authored By: {{ $post->user->name }}
    </p>

    <form action="{{ route('comments.store') }}" method="post">
        @csrf

        <input type="hidden" value="{{ $post->id }}" name="post_id">

        <label for="comment">Comment:</label>
        <input type="text" id="comment" name="comment">
        @error('comment')
            <p style="color: red">{{ $message }}</p>
        @enderror

        <button type="submit">Submit</button>
    </form>

    <ul>
        @foreach ($post->comments as $comment)
            <li>
                {{ $comment->user->name }}: {{ $comment->comment }}
                <form action="{{ route('comments.destroy', $comment->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button>Delete Comment</button>
                </form>
            </li>
        @endforeach
    </ul>

</x-app-layout>