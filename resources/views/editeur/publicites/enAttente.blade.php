
@extends('editeur.layout')

@section('title', 'Mes publicités en attente')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-pink-600 mb-6">⏳ Mes publicités en attente</h1>

    @if($publicites->count())

        {{-- ✅ VERSION MOBILE --}}
        <div class="space-y-4 md:hidden">
            @foreach($publicites as $pub)
                <div class="bg-yellow-50 border border-yellow-200 shadow rounded p-4 text-sm">
                    <h2 class="text-lg font-semibold text-gray-800 mb-1">{{ $pub->titre }}</h2>
                    <p class="text-gray-600 mb-1">Soumise le {{ $pub->created_at->format('d/m/Y') }}</p>
                    <p>
                        Lien :
                        <a href="{{ $pub->lien }}" target="_blank" class="text-blue-600 underline">Voir</a>
                    </p>
                    @if ($pub->is_approved && ! $pub->paid)
                        <p class="text-orange-600 font-semibold mt-2">⚠️ À payer</p>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- ✅ VERSION DESKTOP --}}
        <div class="hidden md:block overflow-x-auto mt-4">
            <table class="w-full bg-white shadow rounded text-sm">
                <thead>
                    <tr class="bg-pink-100 text-pink-800 uppercase text-xs">
                        <th class="px-4 py-3 text-left">Titre</th>
                        <th class="px-4 py-3 text-left">Soumise le</th>
                        <th class="px-4 py-3 text-left">Lien</th>
                        <th class="px-4 py-3 text-left">À payer</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($publicites as $pub)
                        <tr class="border-t hover:bg-yellow-50">
                            <td class="px-4 py-2 font-semibold text-gray-800">{{ $pub->titre }}</td>
                            <td class="px-4 py-2 text-gray-600">{{ $pub->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ $pub->lien }}" target="_blank" class="text-blue-600 hover:underline">Voir le lien</a>
                            </td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @else
        <p class="text-gray-600">Aucune publicité en attente.</p>
    @endif

    <div class="mt-6">
        <a href="{{ route('editeur.dashboard') }}" class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded">
            ← Retour au tableau de bord
        </a>
    </div>
</div>
@endsection
