<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>

        <a href="{{ route('posts.create') }}">
            Create New Post
        </a>
    </x-slot>

    @if(Carbon\Carbon::parse(auth()->user()->created_at)->format('m-d-y') === Carbon\Carbon::now()->format('m-d-y'))
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __("You're logged in!") }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    @foreach ($posts as $post)
        <div style="border: 1px solid red; margin: 5px">
            <a href="{{ route('posts.show', $post->id) }}">
                <strong>{{ $post->title }}</strong>
            </a>
            <p>
                {{ $post->body }}
            </p>
        </div>
    @endforeach

    {{ $posts->links() }}
</x-app-layout>
