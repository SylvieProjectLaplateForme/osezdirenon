@extends('admin.layout')

@section('title', 'Toutes les publicités')

@section('content')

{{--  Message de succès (renouvellement ou autre) --}}
@if(session('success'))
<div class="mb-4 text-green-600 font-semibold">
     {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="mb-4 text-red-600 font-semibold">
    ❌ {{ session('error') }}
</div>
@endif


<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-6">📢 Toutes les publicités</h1>

    @if($publicites->isEmpty())
        <p class="text-gray-500">Aucune publicité trouvée.</p>
    @else
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead>
                    <tr class="bg-gray-100 text-gray-700 text-sm uppercase">
                        <th class="px-6 py-3 text-left">Titre</th>
                        <th class="px-6 py-3 text-left">Auteur</th>
                        <th class="px-6 py-3 text-left">Lien</th>
                        <th class="px-6 py-3 text-left">Statut</th>
                        <th class="px-6 py-3 text-left">Créée le</th>
                        <th class="px-6 py-3 text-left">Début</th>
                        <th class="px-6 py-3 text-left">Valide jusqu’au</th>
                        <th class="px-6 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($publicites as $pub)
                    <tr class="border-b text-gray-700">
                        <td class="px-6 py-4">{{ $pub->titre }}</td>
                        <td class="px-6 py-4">{{ $pub->user->name ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <a href="{{ $pub->lien }}" class="text-blue-600 hover:underline" target="_blank">Voir</a>
                        </td>
                        <td class="px-6 py-4">
                            @if($pub->is_approved)
                                <span class="text-green-600 font-semibold">Validée</span>
                            @else
                                <span class="text-yellow-500 font-semibold">En attente</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            {{ $pub->created_at ? \Carbon\Carbon::parse($pub->created_at)->format('d/m/Y') : '-' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $pub->date_debut ? \Carbon\Carbon::parse($pub->date_debut)->format('d/m/Y') : '-' }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $pub->valid_until ? \Carbon\Carbon::parse($pub->valid_until)->format('d/m/Y') : 'Non définie' }}
                        </td>
            
                            <td class="px-6 py-4 flex gap-2 flex-wrap">
                                @if(!$pub->is_approved)
                                    <form method="POST" action="{{ route('admin.publicites.valider', $pub->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <button class="text-green-600 hover:underline">Valider</button>
                                    </form>
                                @endif

                                
                                {{-- 🗑 Supprimer --}}
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

        {{-- ✅ Pagination --}}
        <div class="mt-6">
            {{ $publicites->links() }}
        </div>
    @endif

    <div class="mt-8">
        <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:underline">← Retour au dashboard</a>
    </div>
</div>
@endsection


