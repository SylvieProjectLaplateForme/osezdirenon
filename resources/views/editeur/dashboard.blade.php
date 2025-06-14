@extends('editeur.layout')

@section('title', 'Dashboard Éditeur')

@section('content')
@if (session('success'))
    <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6 shadow">
        {{ session('success') }}
    </div>
@endif
@if(auth()->user()->notifications->count())
    <div class="bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded mb-6 shadow">
        <h3 class="font-semibold mb-2">📢 Notifications</h3>
        <ul class="list-disc list-inside text-sm">
            @foreach(auth()->user()->notifications as $notification)
                <li class="mb-1">
                    {{ $notification->data['message'] ?? 'Notification' }}
                    {{-- 🔗 lien possible vers la publicité validée --}}
                    @if(isset($notification->data['publicite_id']))
                        <a href="{{ route('editeur.publicites.index') }}" class="text-blue-600 underline text-sm">(voir)</a>
                    @endif
                </li>
            @endforeach
        </ul>
        <form action="{{ route('notifications.clear') }}" method="POST" class="mt-3 text-right">
            @csrf
            <button type="submit" class="text-xs text-gray-500 hover:underline">
                Tout marquer comme lu
            </button>
        </form>
    </div>
@endif

<div class="flex justify-between items-center mb-4">
    <h1 class="text-2xl font-bold">Bienvenue, {{ Auth::user()->name }}</h1>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
    <div class="bg-white rounded shadow p-4 text-center">
        <h2 class="text-lg font-semibold">Mes articles</h2>
        <p class="text-2xl font-bold">{{ $totalArticles ?? 0 }}</p>
        <a href="{{ route('editeur.articles.index') }}" class="text-blue-500 hover:underline">Voir </a>
    </div>

    <div class="bg-white rounded shadow p-4 text-center">
        <h2 class="text-lg font-semibold">Articles en attente</h2>
        <p class="text-2xl font-bold">{{ $attenteArticles ?? 0 }}</p>
        <a href="{{ route('editeur.articles.enAttente') }}" class="text-blue-500 hover:underline">Voir </a>
    </div>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded shadow p-4 text-center">
        <h2 class="text-lg font-semibold">Mes Publicités </h2>
        <p class="text-2xl font-bold">{{ $totalPublicites ?? 0 }}</p>
        <a href="{{ route('editeur.publicites.index') }}" class="text-blue-500 hover:underline">Voir </a>
    </div>

    <div class="bg-white rounded shadow p-4 text-center">
    <h3 class="text-lg font-semibold">À Payer</h3>
    <p class="text-2xl font-bold">{{ $pubsAPayer }}</p>
    <a href="{{ route('editeur.publicites.a_payer') }}" class="text-blue-500 hover:underline ">
        Voir
    </a>
</div>
    
    <div class="bg-white rounded shadow p-4 text-center">
        <h2 class="text-lg font-semibold">Mes paiements</h2>
        <p class="text-2xl font-bold">{{ $totalPaiements ?? 0 }}</p>
        <a href="{{ route('editeur.paiements.index') }}" class="text-blue-500 hover:underline">Voir </a>
    </div>
</div>

{{-- Tableau de derniers articles --}}
<div class="bg-white rounded shadow p-6">
    <h2 class="text-xl font-semibold mb-4">Derniers articles</h2>
    <table class="min-w-full">
        <thead>
            <tr>
                <th class="text-left px-4 py-2 border-b">Titre</th>
                <th class="text-left px-4 py-2 border-b">Statut</th>
                <th class="text-left px-4 py-2 border-b">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($articles as $article)
                <tr>
                    <td class="px-4 py-2 border-t">{{ $article->title }}</td>
                    <td class="px-4 py-2 border-t">
                        @if ($article->is_approved)
                            <span class="text-green-600">✔ Validé</span>
                        @else
                            <span class="text-yellow-600">⏳ En attente</span>
                        @endif
                    </td>
                    <td class="px-4 py-2 border-t">
                        <a href="{{ route('article.show', $article->slug) }}" class="text-blue-600 hover:underline">Voir</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-gray-500 py-4">Aucun article pour le moment.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
