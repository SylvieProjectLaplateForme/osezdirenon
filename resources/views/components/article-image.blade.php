
@props(['image', 'alt' => ''])

@php
    use Illuminate\Support\Str;

    $isUrl = Str::startsWith($image, ['http://', 'https://']);
    $isUploaded = Str::startsWith($image, 'articles/') && file_exists(public_path('storage/' . $image));
    $isSeeder = Str::startsWith($image, 'articles/') && file_exists(public_path($image));
    $defaultImage = asset('storage/articles/defaut.jpg');
@endphp

@if ($image)
    @if ($isUrl)
        <img src="{{ $image }}" alt="{{ $alt }}" class="w-full h-auto rounded-xl shadow">
    @elseif ($isUploaded)
        <img src="{{ asset('storage/' . $image) }}" alt="{{ $alt }}" class="w-full h-auto rounded-xl shadow">
    @elseif ($isSeeder)
        <img src="{{ asset($image) }}" alt="{{ $alt }}" class="w-full h-auto rounded-xl shadow">
    @else
        <img src="{{ $defaultImage }}" alt="Image par défaut" class="w-full h-auto rounded-xl shadow">
    @endif
@else
    <img src="{{ $defaultImage }}" alt="Image par défaut" class="w-full h-auto rounded-xl shadow">
@endif
