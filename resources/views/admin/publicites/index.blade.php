@extends('admin.layout')

@section('title', 'Toutes les publicités')

@section('content')
<h1 class="text-2xl font-bold mb-6">Toutes les publicités</h1>

@if($publicites->count())
    <table class="min-w-full bg-white shadow rounded-lg">
        <thead>
            <tr>
                <th class="px-4 py-2 border-b text-left">Titre</th>
                <th class="px-4 py-2 border-b text-left">Lien</th>
                <th class="px-4 py-2 border-b text-left">Auteur</th>
                <th class="px-4 py-2 border-b text-left">Validée ?</th>
                <th class="px-4 py-2 border-b text-left">Payée ?</th>
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
                    <td class="px-4 py-2">
                        {{ $pub->is_approved ? '✅' : '❌' }}
                    </td>
                    <td class="px-4 py-2">
                        {{ $pub->paid ? '✅' : '❌' }}
                    </td>
                    <td class="px-4 py-2 flex gap-2">
                        @if (!$pub->is_approved)
                        <form method="POST" action="{{ route('admin.publicites.valider', $pub->id) }}">
                            @csrf
                            @method('PUT')
                            <button class="text-green-600 hover:underline">Valider</button>
                        </form>
                        @endif

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
@else
    <p>Aucune publicité trouvée.</p>
@endif
@endsection
