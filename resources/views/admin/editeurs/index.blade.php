@extends('admin.layout')

@section('title', 'Liste des éditeurs')

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-2xl font-bold mb-6">Liste des éditeurs</h1>

    <table class="min-w-full bg-white shadow-md rounded">
        <thead>
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
@endsection
