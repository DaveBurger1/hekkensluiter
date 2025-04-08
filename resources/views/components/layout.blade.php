<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{ $headBefore ?? '' }}

    <title>Home</title>

    <link rel="icon" type="image/png" sizes="256x256"
        href="{{ Vite::asset('resources/icons/app/Afbeelding_256.png') }}">
    <link rel="icon" type="image/png" sizes="180x180"
        href="{{ Vite::asset('resources/icons/app/Afbeelding_180.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ Vite::asset('resources/icons/app/Afbeelding_180.png') }}">
    <link rel="icon" type="image/png" sizes="128x128"
        href="{{ Vite::asset('resources/icons/app/Afbeelding_128.png') }}">
    <link rel="icon" type="image/png" sizes="64x64"
        href="{{ Vite::asset('resources/icons/app/Afbeelding_64.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ Vite::asset('resources/icons/app/Afbeelding_32.png') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    {{ $headAfter ?? '' }}
</head>

<body>
    {{ $slot }}
</body>

</html>