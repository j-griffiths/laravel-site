<x-app-layout>

    <x-slot name="title">
        Posts
    </x-slot>

    <x-slot name="header">
        <div class="flex items-center">
            <div class="flex-1">
                {{ __('Posts') }}
            </div>
            <a href="posts/create" class="float-right bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                Create Post
            </a> 
        </div>
    </x-slot>

    @include('layouts.pagination', ['items' => $posts])

</x-app-layout>
