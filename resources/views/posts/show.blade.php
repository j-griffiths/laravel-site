<x-app-layout>

    <x-slot name="title">
        {{ $post->title }}
    </x-slot>

    <x-slot name="header">
        {{ $post->title }}
    </x-slot>

    {{$post->profile_user_id}}

    {{$post->content}}

    @if ($post->imagePath)
        <img src="../{{ $post->imagePath }}" />
    @endif
    
    {{$post->created_at}}

</x-app-layout>

<script>
</script>
