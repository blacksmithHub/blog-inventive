<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create New Post') }}
        </h2>
    </x-slot>

    <a href="{{ route('dashboard') }}">Back</a>

    <form action="{{ route('posts.store') }}" method="post">
        @csrf

        <label for="title">Title:</label>
        {{-- <input type="text" id="title" name="title"> --}}
        <x-text-input name="title" required/>

        <br>

        <label for="body">Body:</label>
        <textarea name="body" id="body" cols="30" rows="10" required></textarea>

        <br>

        <button type="submit">
            Submit
        </button>
    </form>

</x-app-layout>