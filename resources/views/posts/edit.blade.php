<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <a href="{{ route('dashboard') }}">Back</a>

    <form action="{{ route('posts.update', $post->id) }}" method="post">
        @csrf
        @method('PUT')

        <label for="title">Title:</label>
        <x-text-input name="title" required value="{{ $post->title }}"/>

        <br>

        <label for="body">Body:</label>
        <textarea name="body" id="body" cols="30" rows="10" required>{{ $post->body }}</textarea>

        <br>

        <button type="submit">
            Submit
        </button>
    </form>

</x-app-layout>