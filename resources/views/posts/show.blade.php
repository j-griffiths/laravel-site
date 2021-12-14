<x-app-layout>

    <x-slot name="title">
        {{ $post->title }}
    </x-slot>

    <x-slot name="header">
        {{ $post->title }}
    </x-slot>

    {{$post->content}}

</x-app-layout>

<script>
</script>
