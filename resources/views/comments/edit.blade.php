<x-app-layout>

    <x-slot name="title">
        Edit Comment
    </x-slot>

    <x-slot name="header">
        <div class="flex items-center">
            <div class="flex-1">
                Edit Comment (#{{ $comment->id }})
            </div>
            <form method="POST" action="{{ route('comments.destroy', ['comment' => $comment]) }}">
                @csrf
                @method('DELETE')
                <input class="float-right bg-transparent hover:bg-red-500 text-red-700 font-semibold hover:text-white py-2 px-4 border border-red-500 hover:border-transparent rounded"
                    id="submit-delete" type="submit" value="Delete Comment"> 
            </form>
        </div>
    </x-slot>

    <form method="POST" action="{{ route('comments.update', ['comment' => $comment]) }}">
        @csrf
        @method('PATCH')
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <p class="text-gray-600 text-xs italic mb-4"> * = Required field. </p>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full h-full px-3">
                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-content">
                    Comment*
                </label>
                <textarea
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 h-80 leading-tight 
                    focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-comment" type="text" placeholder="Example Comment" name="comment">@if(old('comment')){{old('comment')}}@else{{ $comment->content }}@endif</textarea>
            </div>
        </div>
        <div class="flex items-center">
            <div class="flex-1">
                <a href="{{ route('posts.show', ['post' => $comment->post]) }}"
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
