@extends('layout')

@section('title', 'Publicités')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Publicités</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @forelse ($publicites as $pub)
            <div class="bg-white p-4 shadow rounded">
                <h2 class="font-semibold">{{ $pub->titre }}</h2>
                <p>{{ $pub->description }}</p>
                @if ($pub->lien)
                    <a href="{{ $pub->lien }}" class="text-blue-500 underline" target="_blank">Voir la publicité</a>
                @endif
            </div>
        @empty
            <p>Aucune publicité disponible pour le moment.</p>
        @endforelse
    </div>
@endsection

@endsection
