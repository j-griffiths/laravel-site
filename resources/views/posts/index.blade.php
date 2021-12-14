<x-app-layout>

    <x-slot name="title">
        Posts
    </x-slot>

    <x-slot name="header">
        <h2 class="flex items-center clearfix">
            <div class="font-semibold text-xl text-gray-800 leading-tight flex-1">
            {{ __('Posts') }}
            </div>
            <a href="posts/create" class="float-right bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">
                Create Post
            </a> 
        </h2>
    </x-slot>

    @include('layouts.paginater', ['items' => $posts])

</x-app-layout>
