@extends('admin.layout')

@section('title', 'Liste des éditeurs')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold text-pink-600 mb-6">👥 Liste des éditeurs</h1>
{{-- ✅ Bouton d’export CSV --}}
    <div class="mb-6">
        <form method="GET" action="{{ route('admin.editeurs.export') }}">
            <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded shadow">
                ⬇️ Exporter la liste au format CSV
            </button>
        </form>
    </div>
    {{-- ✅ TABLEAU pour desktop --}}
    <div class="hidden md:block overflow-x-auto">
        <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-pink-200 text-yellow-700 text-sm uppercase">
                <tr>
                    <th class="px-6 py-3 border-b text-left">Nom</th>
                    <th class="px-6 py-3 border-b text-left">Prénom</th>
                    <th class="px-6 py-3 border-b text-left">Email</th>
                    <th class="px-6 py-3 border-b text-left">Inscrit le</th>
                    <th class="px-6 py-3 border-b text-left">Statut</th>
                    <th class="px-6 py-3 border-b text-left">Articles</th>
                    <th class="px-6 py-3 border-b text-left">Publicités</th>
                    <th class="px-6 py-3 border-b text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($editeurs as $editeur)
                    <tr>
                        <td class="border-t px-6 py-4">{{ $editeur->name }}</td>
                        <td class="border-t px-6 py-4">{{ $editeur->prenom }}</td>
                        <td class="border-t px-6 py-4">{{ $editeur->email }}</td>
                        <td class="border-t px-6 py-4">{{ $editeur->created_at->format('d/m/Y') }}</td>
                        <td class="border-t px-6 py-4">
                            @if ($editeur->is_active)
                                <span class="text-green-600">Actif</span>
                            @else
                                <span class="text-red-600">Désactivé</span>
                            @endif
                        </td>
                        <td class="border-t px-6 py-4">{{ $editeur->articles->count() }}</td>
                        <td class="border-t px-6 py-4">{{ $editeur->publicites->count() }}</td>
                        <td class="border-t px-6 py-4 space-x-2">
                            <form action="{{ route('admin.profil.toggle', $editeur->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="text-yellow-600 hover:underline">
                                    {{ $editeur->is_active ? 'Désactiver' : 'Activer' }}
                                </button>
                            </form>
                            <a href="{{ route('admin.profil.show', $editeur->id) }}" class="text-blue-600 hover:underline">Voir</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- ✅ CARTES pour mobile --}}
    <div class="md:hidden space-y-4">
        @foreach ($editeurs as $editeur)
            <div class="bg-pink shadow rounded-lg p-4">
                <h2 class="text-lg font-semibold text-yellow-700">{{ $editeur->prenom }} {{ $editeur->name }}</h2>
                <p class="text-sm text-gray-600">📧 {{ $editeur->email }}</p>
                <p class="text-sm text-gray-600">🗓️ Inscrit le : {{ $editeur->created_at->format('d/m/Y') }}</p>
                <p class="text-sm">Statut :
                    @if ($editeur->is_active)
                        <span class="text-green-600 font-semibold">Actif</span>
                    @else
                        <span class="text-red-600 font-semibold">Désactivé</span>
                    @endif
                </p>
                <p class="text-sm text-gray-600">📝 Articles : {{ $editeur->articles->count() }}</p>
                <p class="text-sm text-gray-600">💬 Publicités : {{ $editeur->publicites->count() }}</p>

                <div class="mt-3 flex flex-wrap gap-3">
                    <form action="{{ route('admin.profil.toggle', $editeur->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="text-yellow-600 underline">
                            {{ $editeur->is_active ? 'Désactiver' : 'Activer' }}
                        </button>
                    </form>
                    <a href="{{ route('admin.profil.show', $editeur->id) }}" class="text-blue-600 underline">Voir</a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="mt-8">
        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">← Retour au dashboard</a>
    </div>
</div>
@endsection
