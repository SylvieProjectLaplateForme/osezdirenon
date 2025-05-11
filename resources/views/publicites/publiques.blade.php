@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-8 px-4">
    <h1 class="text-3xl font-bold mb-6">Nos publicités en ligne</h1>

    @if($publicites->count())
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($publicites as $pub)
                <div class="bg-white p-4 shadow rounded">
                    <h2 class="text-xl font-semibold mb-2">{{ $pub->titre }}</h2>

                    @if($pub->image)
                        <img src="{{ asset('storage/' . $pub->image) }}" alt="{{ $pub->titre }}" class="w-full h-48 object-cover rounded mb-3">
                    @endif

                    <a href="{{ $pub->lien }}" target="_blank" class="text-blue-600 underline">Visiter le site</a>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600">Aucune publicité active pour le moment.</p>
    @endif
</div>
@endsection
