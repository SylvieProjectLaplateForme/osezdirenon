@extends('editeur.layout')

@section('title', 'Publicités à payer')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-pink-600 mb-6">💳 Publicités en attente de paiement</h1>

    @if($publicites->count())

        {{-- ✅ VERSION MOBILE --}}
        <div class="space-y-4 md:hidden">
            @foreach($publicites as $pub)
                <div class="bg-pink-100 text-pink-800 uppercase text-x">
                    <h2 class="text-lg font-semibold text-gray-800 mb-1">{{ $pub->titre }}</h2>
                    <p class="text-gray-600">Validée le {{ $pub->updated_at->format('d/m/Y') }}</p>
                    <p class="text-blue-600 underline mb-2">
                        <a href="{{ $pub->lien }}" target="_blank">Voir la publicité</a>
                    </p>
                    <form action="{{ route('stripe.checkout', $pub->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">
                            💳 Payer maintenant
                        </button>
                    </form>
                </div>
            @endforeach
        </div>

        {{-- ✅ VERSION DESKTOP --}}
        <div class="hidden md:block overflow-x-auto mt-6">
            <table class="w-full bg-white shadow rounded text-sm">
                <thead>
                    <tr class="bg-pink-100 text-pink-800 uppercase text-xs">
                        <th class="px-4 py-3 text-left">Titre</th>
                        <th class="px-4 py-3 text-left">Validée le</th>
                        <th class="px-4 py-3 text-left">Lien</th>
                        <th class="px-4 py-3 text-left">Paiement</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($publicites as $pub)
                        <tr class="border-t hover:bg-blue-50">
                            <td class="px-4 py-2 font-semibold text-gray-800">{{ $pub->titre }}</td>
                            <td class="px-4 py-2 text-gray-600">{{ $pub->updated_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ $pub->lien }}" target="_blank" class="text-blue-600 hover:underline">Voir</a>
                            </td>
                            <td class="px-4 py-2">
                                <form action="{{ route('stripe.checkout', $pub->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-blue-600 text-white px-4 py-1 rounded hover:bg-blue-700">
                                        💳 Payer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @else
        <p class="text-gray-600">Aucune publicité en attente de paiement.</p>
    @endif

    <div class="mt-6">
        <a href="{{ route('editeur.dashboard') }}" class="inline-block text-blue-600 hover:underline">
            ← Retour au tableau de bord
        </a>
    </div>
</div>
@endsection
