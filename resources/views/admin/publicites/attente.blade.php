@extends('admin.layout')

@section('title', 'Publicités en attente')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-pink-600 mb-6">📢 Publicités en attente de validation</h1>

    @if($publicites->count())

        {{-- ✅ TABLEAU desktop --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="min-w-full bg-white shadow rounded-lg">
                <thead class="bg-pink-200 text-yellow-700 text-sm uppercase">
                    <tr>
                        <th class="px-4 py-2 border-b text-left">Titre</th>
                        <th class="px-4 py-2 border-b text-left">Lien</th>
                        <th class="px-4 py-2 border-b text-left">Auteur</th>
                        <th class="px-4 py-2 border-b text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($publicites as $pub)
                        <tr class="border-t">
                            <td class="px-4 py-2">{{ $pub->titre }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ $pub->lien }}" target="_blank" class="text-blue-600 underline">Voir</a>
                            </td>
                            <td class="px-4 py-2">{{ $pub->user->name ?? '—' }}</td>
                            <td class="px-4 py-2 flex gap-2">
                                <form method="POST" action="{{ route('admin.publicites.valider', $pub->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button class="text-green-600 hover:underline">Valider</button>
                                </form>
                                <form method="POST" action="{{ route('admin.publicites.destroy', $pub->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:underline">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- ✅ CARTES mobile --}}
        <div class="md:hidden space-y-4">
            @foreach($publicites as $pub)
                <div class="bg-white shadow rounded-lg p-4">
                    <h2 class="text-lg font-semibold text-gray-800">{{ $pub->titre }}</h2>
                    <p class="text-sm text-gray-600">🔗 
                        <a href="{{ $pub->lien }}" target="_blank" class="text-blue-600 underline">Voir le lien</a>
                    </p>
                    <p class="text-sm text-gray-600">👤 Auteur : {{ $pub->user->name ?? '—' }}</p>

                    <div class="mt-3 flex flex-wrap gap-3">
                        <form method="POST" action="{{ route('admin.publicites.valider', $pub->id) }}">
                            @csrf
                            @method('PUT')
                            <button class="text-green-600 underline">Valider</button>
                        </form>
                        <form method="POST" action="{{ route('admin.publicites.destroy', $pub->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 underline">Supprimer</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

    @else
        <p class="text-gray-600">Aucune publicité en attente pour le moment.</p>
    @endif

    <div class="mt-8">
        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">← Retour au dashboard</a>
    </div>
</div>
@endsection
