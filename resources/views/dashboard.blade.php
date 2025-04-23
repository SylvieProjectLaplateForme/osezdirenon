@extends('layout')

@section('title', 'Dashboard Admin')

@section('content')
<@section('content')
<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Bonjour, {{ Auth::user()->name }}</h1>
    <span class="bg-red-600 text-white px-2 py-1 rounded text-sm">Admin</span>
</div>


<div class="grid grid-cols-3 gap-4 mb-8">
    <div class="bg-white rounded shadow p-4 text-center">
        <h2 class="text-lg font-semibold">Tous les articles</h2>
        <p class="text-2xl font-semibold">{{ $total }}</p>
        <a href="{{ route('admin.dashboard') }}" class="text-blue-500 hover:underline">Voir</a>
    </div>

    <div class="bg-white rounded shadow p-4 text-center">
        <h2 class="text-lg font-semibold">Validés</h2>
        <p class="text-2xl font-semibold">{{ $valides }}</p>
        <a href="{{ route('admin.dashboard', ['filter' => 'valide']) }}" class="text-blue-500 hover:underline">Voir</a>
    </div>

    <div class="bg-white rounded shadow p-4 text-center">
        <h2 class="text-lg font-semibold">En attente</h2>
        <p class="text-2xl font-semibold">{{ $attente }}</p>
        <a href="{{ route('admin.dashboard', ['filter' => 'attente']) }}" class="text-blue-500 hover:underline">Voir</a>
    </div>
</div>

<table class="min-w-full bg-white shadow-md rounded">
    <thead>
        <tr>
            <th class="px-6 py-3 border-b text-left">Titre</th>
            <th class="px-6 py-3 border-b text-left">Auteur</th>
            <th class="px-6 py-3 border-b text-left">Statut</th>
            <th class="px-6 py-3 border-b text-left">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($articles as $article)
            <tr>
                <td class="border-t px-6 py-4">{{ $article->title }}</td>
                <td class="border-t px-6 py-4">{{ $article->user->name }}</td>
                <td class="border-t px-6 py-4">
                    @if ($article->is_approved)
                        <span class="text-green-600">Validé</span>
                    @else
                        <span class="text-red-600">En attente</span>
                    @endif
                </td>
                <td class="border-t px-6 py-4 flex gap-2">
                    @if (!$article->is_approved)
                        <form method="POST" action="{{ route('admin.article.validate', $article->id) }}">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="text-green-600 hover:underline">Valider</button>
                        </form>
                    @endif
                    <form method="POST" action="{{ route('admin.article.destroy', $article->id) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                    </form>
                    <a href="{{ route('admin.article.show', $article->id) }}" class="text-blue-600 hover:underline">Voir</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
