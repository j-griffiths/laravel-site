<x-app-layout>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <x-slot name="title">
        {{ $post->title }}
    </x-slot>

    <x-slot name="header">
        <div class="flex items-center">
            <div class="flex-1">
                {{ $post->title }}
                <div class="text-sm italic mt-2">
                    Posted by <span class="font-bold text-blue-400"> {{ $post->profile->user->name }} </span> at
                    {{ $post->created_at }}
                </div>
            </div>
            @can('update', $post)
                <a href="{{ route('posts.edit', ['post' => $post]) }}"
                    class="float-right bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded"
                    id="edit-button">Edit Post</a>
            @endcan
        </div>
    </x-slot>

    <div id="root">

        @if ($post->imagePath)
            <div class="relative 6/7 bg-red-500" style="padding-bottom: 56.25%">
                <img src="../{{ $post->imagePath }}" alt="Image Uploaded by Poster"
                    class="absolute h-full w-full object-cover" />
            </div>
        @endif

        <div class="text-base break-words mt-4">
            <div class="mb-4">
                {{ $post->content }}
            </div>
            <div class="flex">
                <div class="flex-1"></div>
                <div class="float-right">
                    <like-button likeable_id="{{ $post->id }}"
                        like_exists="{{ auth()->user()->profile->likedPosts->contains($post) }}" likeable_type="post">
                    </like-button>
                </div>
            </div>
        </div>

        <div class="font-bold text-xl mt-6 mb-2">
            Comments
        </div>
        <div class="mb-2">
            <textarea
                class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-2 px-4 mb-3 h-20 leading-tight 
                focus:outline-none focus:bg-white focus:border-gray-500"
                id="input" v-model="newComment" type="text" placeholder="Type your comment here!"
                name="commentInput">{{ old('commentInput') }}</textarea>
            <div class="mb-6 flex items-center">
                <span class="flex-1 text-sm italic text-red-500" id="errorText"></span>
                <button
                    class="float-right bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 
                hover:border-transparent rounded w-1/7"
                    onclick="app.createComment()">Comment</button>
            </div>
        </div>

        <div class="mb-4 border-t flex-col" v-for="comment in comments">
            <div class="mb-2 font-semibold text-sm flex-1">
                @{{ comment . name }}
                @{{ comment . created_at . split('T')[0] + ' ' + comment . created_at . split('T')[1] . split('.')[0] }}
            </div>
            <div class="text-base">
                @{{ comment . content }}
            </div>
            <div class="flex items-center">
                <div class="text-sm flex-1 flex items-center">
                    <div class="flex-1" v-if="(admin == 1 || profile_id == comment.profile_id)">
                    <a :href="setLink(comment.id)" 
                        class="bg-transparent hover:bg-green-500 w-1/7 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded"
                        id="edit-button">Edit</a>
                    </div>
                    <div class="flex-1">
                    </div>
                    <like-button class="float-right" :likeable_id="comment.id" :like_exists="false"
                        likeable_type="comment"></like-button>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-center">

            <button
                class="mr-2 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
                onclick="app.prevComments()">Previous</button>
            <div class="font-semibold italic mr-2">
                Page <span v-text="current_page"></span> of <span v-text="last_page"></span>
            </div>
            <button
                class="mr-2 bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded"
                onclick="app.nextComments()">Next</button>
        </div>

        <div class="mb-2 border-t italic text-base" v-if="anyComments">
            This post has no comments yet.
        </div>


    </div>

</x-app-layout>

<script>
    Vue.component('like-button', {
        props: [
            'likeable_id',
            'like_exists',
            'likeable_type',
        ],
        data: function() {
            return {
                status: this.like_exists,
            };
        },
        methods: {
            createLike() {
                if (this.status == false) {
                    axios.post("{{ route('api.likes.store') }}", {
                        likeable_id: this.likeable_id,
                        likeable_type: this.likeable_type,
                    }).then(response => {
                        console.log(response.data);
                        this.status = !this.status;
                    }).catch(error => {
                        console.log(error.response.data);
                    });
                } else {
                    axios.post("{{ route('api.likes.destroy') }}", {
                        likeable_id: this.likeable_id,
                        likeable_type: this.likeable_type,
                    }).then(response => {
                        console.log(response.data);
                        this.status = !this.status;
                    }).catch(error => {
                        console.log(error.response.data);
                    });
                };
            },
        },
        computed: {
            /**
             * @return {string}
             */
            likeText() {
                return (this.status) ? 'UNLIKE' : 'LIKE';
            },
        },
        template: '<button v-on:click="createLike" class="bg-transparent hover:bg-green-500 text-green-700 font-semibold hover:text-white py-2 px-4 border border-green-500 hover:border-transparent rounded" v-text="likeText"></button>'
    });

    var app = new Vue({
        el: "#root",
        data: {
            comments: [],
            newComment: '',
            pagination: [],
            current_page: 1,
            last_page: 0,
            profile_id: {{auth()->user()->profile->id}},
            admin: {{auth()->user()->isAdministrator()}},
        },
        mounted: function() {
            this.getComments();
        },
        methods: {
            createComment: function() {
                axios.post("{{ route('api.posts.comments.store', ['post' => $post]) }}", {
                    comment: this.newComment,
                }).then(response => {
                    console.log(response.data);
                    this.newComment = '';
                    this.getComments();
                }).catch(error => {
                    console.log(error.response.data);
                    document.getElementById('errorText').textContent = error.response.data.errors
                        .comment;
                });
            },
            getComments: function() {
                axios.get("{{ route('api.posts.comments.index', ['post' => $post]) }}")
                    .then(response => {
                        console.log(response.data);
                        let x = JSON.parse(response.data.comments);
                        this.comments = x.data;
                        this.next_url = x.next_page_url;
                        this.prev_url = x.prev_page_url;
                        this.current_page = x.current_page;
                        this.last_page = x.last_page;
                    }).catch(error => {
                        console.log(error.response.data);
                    });
            },
            nextComments: function() {
                if (this.next_url == null) {
                    return;
                };
                axios.get(this.next_url)
                    .then(response => {
                        console.log(response.data);
                        let x = JSON.parse(response.data.comments);
                        this.comments = x.data;
                        this.next_url = x.next_page_url;
                        this.prev_url = x.prev_page_url;
                        this.current_page = x.current_page;
                    }).catch(error => {
                        console.log(error.response.data);
                    });
            },
            prevComments: function() {
                if (this.prev_url == null) {
                    return;
                };
                axios.get(this.prev_url)
                    .then(response => {
                        console.log(response.data);
                        let x = JSON.parse(response.data.comments);
                        this.comments = x.data;
                        this.next_url = x.next_page_url;
                        this.prev_url = x.prev_page_url;
                        this.current_page = x.current_page;
                    }).catch(error => {
                        console.log(error.response.data);
                    });
            },
            setLink(id) {
                let url = "{{ route('comments.edit', ':id') }}";
                url = url.replace(':id', id);
                return url;
            },
        },
        computed: {
            anyComments() {
                return this.comments === [];
            },
            permissions() {
                return ;
            }
        },
    });
</script>
