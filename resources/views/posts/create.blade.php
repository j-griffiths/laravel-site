<x-app-layout>

    <x-slot name="title">
        Create Post
    </x-slot>

    <x-slot name="header">
        Create New Post
    </x-slot>

    <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <p class="text-gray-600 text-xs italic mb-4"> * = Required field. </p>
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-title">
                    Title*
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="grid-title" type="text" placeholder="Example Title" name="title" value="{{ old('title') }}">
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-image">
                    Upload Image
                </label>
                <input  type="file" name="uploadedFile" accept="image/*">
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full h-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-content">
                    Content*
                </label>
                <textarea
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 h-80 leading-tight 
                    focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-content" type="text" placeholder="Example Content" name="content">{{ old('content') }}</textarea>
            </div>
        </div>
        <div class="flex items-center">
            <div class="flex-1">
                <a href="{{ route('posts.index') }}"
                    class="bg-red-500 text-white font-semibold py-2 px-4 border border-red-700 hover:bg-red-700 rounded w-1/7"
                    id="grid-cancel">
                    Cancel
                </a>
            </div>
            <input
                class="float-right bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded w-1/7"
                id="grid-submit" type="submit" value="Create">
        </div>
    </form>

</x-app-layout>

<script>
</script>
