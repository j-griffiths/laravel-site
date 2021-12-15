<x-app-layout>

    <x-slot name="title">
        {{ $post->title }}
    </x-slot>

    <x-slot name="header">
        {{ $post->title }}
        <div class="text-sm italic mt-2">
            Posted by <span class="font-bold text-blue-400"> {{ $post->profile->user->name }} </span> at
            {{ $post->created_at }}
        </div>
    </x-slot>

    @if ($post->imagePath)
        <div class="relative w-full bg-red-500" style="padding-bottom: 56.25%">
            <img src="../{{ $post->imagePath }}" alt="Image Uploaded by Poster"
                class="absolute h-full w-full object-cover" />
        </div>
    @endif

    <div class="text-base mt-4">
        {{ $post->content }}
    </div>

    <div class="font-bold text-xl mt-6 mb-2">
        Comments
    </div>
    <div id="commentSection">
        <div class="mb-2">
            <textarea
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 h-20 leading-tight 
                focus:outline-none focus:bg-white focus:border-gray-500"
                id="input" v-model="newComment" type="text" placeholder="Type your comment here!"
                name="commentInput">{{ old('commentInput') }}</textarea>
            <div class="mb-16">
                <button
                    class="float-right bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 
                hover:border-transparent rounded w-1/7"
                    onclick="app.createComment()">Comment</button>
            </div>
        </div>

        <div class="mb-4 border-t flex-col" v-for="comment in comments">
            <div class="mb-2 font-semibold text-sm flex-1">
                @{{ comment.profile_id }}
            </div>
            <div class="text-base">
                @{{ comment.content }}
            </div>
            <div class="text-sm italic float-right">
                @{{ comment.created_at }}
            </div>
        </div>


        <div id="noComments" class="mb-2 border-t italic text-base">
            This post has no comments yet.
        </div>

    </div>

</x-app-layout>

<script>
    var app = new Vue({
        el: "#commentSection",
        data: {
            comments: <?php echo json_encode($post->comments); ?>,
            newComment: '',
            post_id: {{ $post->id }},
        },
        mounted: function () {
            if (this.comments.length === 0) {
                document.getElementById('noComments').style.display='';
            } else {
                document.getElementById('noComments').style.display='none';
            }
        },
        methods: {
            createComment: function() {
                axios.post("{{ route('comments.store') }}", {
                    comment: this.newComment,
                    post_id: this.post_id,
                }).then(response => {
                    this.comments.push(response.data.comment);
                    this.newComment='';
                    document.getElementById('noComments').style.display='none';
                }).catch(response => {
                    console.log(response);
                });
            },
        },
    });
</script>
