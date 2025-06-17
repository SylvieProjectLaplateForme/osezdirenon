{{-- @php
    use Illuminate\Support\Str;

    // Par défaut, une image neutre si rien du tout
    $imagePath = asset('images/default.jpg');

    if (!empty($image)) {
        // Si l'image existe dans public/articles/
        if (Str::startsWith($image, 'articles/') && file_exists(public_path($image))) {
            $imagePath = asset($image);
        } else {
            // Sinon, c’est un fichier uploadé (dans storage)
            $imagePath = asset('storage/' . $image);
        }
    }
@endphp

<img 
    src="{{ $imagePath }}" 
    alt="{{ $alt ?? 'Image article' }}" 
    {{ $attributes->merge(['class' => 'w-full h-48 object-cover']) }}
> --}}

@props(['image', 'alt' => ''])

@php
    use Illuminate\Support\Str;

    $isUrl = Str::startsWith($image, ['http://', 'https://']);
    $isUploaded = Str::startsWith($image, 'articles/') && file_exists(public_path('storage/' . $image));
    $isSeeder = Str::startsWith($image, 'articles/') && file_exists(public_path($image));
@endphp

@if ($image)
    @if ($isUrl)
        <img src="{{ $image }}" alt="{{ $alt }}" {{ $attributes }}>
    @elseif ($isUploaded)
        <img src="{{ asset('storage/' . $image) }}" alt="{{ $alt }}" {{ $attributes }}>
    @elseif ($isSeeder)
        <img src="{{ asset($image) }}" alt="{{ $alt }}" {{ $attributes }}>
    @else
        <img src="{{ asset('images/default.jpg') }}" alt="Image par défaut" {{ $attributes }}>
    @endif
@else
    <img src="{{ asset('images/default.jpg') }}" alt="Image par défaut" {{ $attributes }}>
@endif
