<x-app-layout>

    <x-slot name="title">
        Edit Post
    </x-slot>

    <x-slot name="header">
        <div class="flex items-center">
            <div class="flex-1">
                Edit Post (#{{ $post->id }})
            </div>
            <form method="POST" action="{{ route('posts.destroy', ['post' => $post]) }}">
                @csrf
                @method('DELETE')
                <input class="float-right bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded"
                    id="submit-delete" type="submit" value="Delete Post"> 
            </form>
        </div>
    </x-slot>

    <form method="POST" action="{{ route('posts.update', ['post' => $post]) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <p class="text-gray-600 text-xs italic mb-4"> * = Required field. </p>
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-title">
                    Title*
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="grid-title" type="text" placeholder="Example Title" name="title" value=
                    @if( old('title') )
                        "{{ old('title') }}"
                    @else 
                        "{{ $post->title }}"
                    @endif
                    >
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
                    id="grid-content" type="text" placeholder="Example Content" name="content">@if(old('content')){{old('content')}}@else{{ $post->content }}@endif</textarea>
            </div>
        </div>
        <div class="flex items-center">
            <div class="flex-1">
                <a href="{{ route('posts.show', ['post' => $post]) }}"
                    class="bg-red-500 text-white font-semibold py-2 px-4 border border-red-700 hover:bg-red-700 rounded w-1/7"
                    id="grid-cancel">
                    Cancel
                </a>
            </div>
            <input
                class="float-right bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded w-1/7"
                id="grid-submit" type="submit" value="Edit">
        </div>
    </form>

</x-app-layout>

<script>
</script>
