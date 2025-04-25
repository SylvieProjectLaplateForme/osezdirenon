@extends('layout')

@section('title', 'Publicités en attente')

@section('content')
<div class="max-w-4xl mx-auto mt-8">
    <h1 class="text-2xl font-bold mb-4">Publicités en attente de validation</h1>

    @foreach ($publicites as $pub)
        <div class="bg-white rounded shadow p-4 mb-4">
            <h2 class="text-xl font-semibold">{{ $pub->titre }}</h2>
            <p class="text-gray-700">Lien : <a href="{{ $pub->lien }}" class="text-blue-600 hover:underline" target="_blank">{{ $pub->lien }}</a></p>

            @if ($pub->image)
                <img src="{{ asset('storage/' . $pub->image) }}" class="w-32 mt-2 rounded">
            @endif

            <div class="mt-4 flex gap-4">
                <form action="{{ route('admin.publicites.valider', $pub->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700">
                        ✅ Valider
                    </button>
                </form>
                <form action="{{ route('admin.publicites.supprimer', $pub->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-600 text-white px-4 py-1 rounded hover:bg-red-700">
                        ❌ Supprimer
                    </button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
