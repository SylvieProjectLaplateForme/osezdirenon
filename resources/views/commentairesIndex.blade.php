@extends('admin.layout')

@section('title', 'Commentaires')

@section('content')
<h1 class="text-3xl font-bold mb-6">🛠️ Liste de tous les commentaires</h1>

{{-- EN ATTENTE --}}
<h2 class="text-xl font-semibold text-yellow-600 mb-4">🕒 Commentaires en attente</h2>

@if($enAttente->isEmpty())
    <p class="mb-8">Aucun commentaire en attente.</p>
@else
    <div class="overflow-x-auto mb-10">
        <table class="min-w-full bg-white border border-yellow-300 rounded shadow text-sm">
            <thead class="bg-yellow-100 text-left">
                <tr>
                    <th class="px-4 py-2 border-b">Article</th>
                    <th class="px-4 py-2 border-b">Auteur</th>
                    <th class="px-4 py-2 border-b">Contenu</th>
                    <th class="px-4 py-2 border-b">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($enAttente as $commentaire)
                    <tr class="hover:bg-yellow-50">
                        <td class="px-4 py-2 border-b">{{ $commentaire->article->title ?? '⚠️ Article supprimé' }} </td>
                        <td class="px-4 py-2 border-b">{{ $commentaire->user->name ?? 'Anonyme' }}</td>
                        <td class="px-4 py-2 border-b">{{ $commentaire->content }}</td>
                        <td class="px-4 py-2 border-b">{{ $commentaire->created_at->format('d/m/Y à H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

{{-- VALIDÉS --}}
<h2 class="text-xl font-semibold text-pink-600 mb-4">✅ Commentaires validés</h2>

@if($valides->isEmpty())
    <p>Aucun commentaire validé.</p>
@else
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-pink-300 rounded shadow text-sm">
            <thead class="bg-pink-100 text-left">
                <tr>
                    <th class="px-4 py-2 border-b">Article</th>
                    <th class="px-4 py-2 border-b">Auteur</th>
                    <th class="px-4 py-2 border-b">Contenu</th>
                    <th class="px-4 py-2 border-b">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($valides as $commentaire)
                    <tr class="hover:bg-green-50">
                        <td class="px-4 py-2 border-b">{{ $commentaire->article->title ?? '⚠️ Article supprimé' }}</td>
                        <td class="px-4 py-2 border-b">{{ $commentaire->user->name ?? 'Anonyme' }}</td>
                        <td class="px-4 py-2 border-b">{{ $commentaire->content }}</td>
                        <td class="px-4 py-2 border-b">{{ $commentaire->created_at->format('d/m/Y à H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif

<a href="{{ route('admin.dashboard') }}" class="inline-block mt-8 text-blue-600 hover:underline">← Retour au dashboard</a>
@endsection
