@php
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
>
