<x-app-layout>

    <x-slot name="title">
        Posts
    </x-slot>

    <x-slot name="header">
        <div class="flex items-center">
            <div class="flex-1">
                {{ __('Posts') }}
            </div>
            <a href="posts/create"
                class="float-right bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                Create Post
            </a>
        </div>
    </x-slot>

    <div class="container flex-col mb-4">
        @foreach ($posts as $post)
            <a href="{{ route('posts.show', ['post' => $post->id]) }}">
            <div class="p-4 border-b hover:bg-gray-50">
                <div class="flex items-center">
                    <div class="text-xl">
                        {{ $post->title }}
                    </div>
                    <div class="text-sm italic flex-1">
                        <div class="mb-2 font-semibold text-sm float-right">
                            {{ $post->profile->user->name }} @ {{ $post->created_at }}
                        </div>
                    </div>
                </div>
            </div>
            </a>
        @endforeach
    </div>

    {{ $posts->links() }}

    {{-- @include('layouts.pagination', ['items' => $posts]) --}}

</x-app-layout>
