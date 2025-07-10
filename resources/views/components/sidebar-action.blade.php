@props(['title'])

<div class="sidebar-action">
    @isset($title)
        <h1>{{ $title }}</h1>
    @endisset
    {{ $slot }}
</div>