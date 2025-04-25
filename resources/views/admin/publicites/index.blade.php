@extends('layout')

@section('content')
<div class="container mt-4">
    {{-- Carrousel des publicités --}}
    @if($publicites->count())
        <div id="pubCarousel" class="carousel slide mb-5" data-bs-ride="carousel" data-bs-interval="5000">
            <div class="carousel-inner">
                {{-- @foreach($publicites as $index => $pub)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        @if($pub->image)
                            <img src="{{ asset('storage/' . $pub->image) }}" class="d-block w-100" alt="{{ $pub->titre }}">
                        @endif
                        <div class="carousel-caption d-none d-md-block bg-light text-dark rounded p-2">
                            <h5>{{ $pub->titre }}</h5>
                            @if($pub->lien)
                                <a href="{{ $pub->lien }}" target="_blank" class="btn btn-primary">Voir</a>
                            @endif
                        </div>
                    </div>
                @endforeach --}}
                @foreach ($publicites as $pub)
                <td class="flex gap-2">
                    {{-- Si pas encore validée --}}
                    @if (!$pub->is_approved)
                        <form method="POST" action="{{ route('admin.publicites.valider', $pub->id) }}">
                            @csrf
                            @method('PUT')
                            <button class="bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                ✅ Valider
                            </button>
                        </form>
                    @endif
                
                    {{-- Si validée mais non payée --}}
                    @if ($pub->is_approved && !$pub->paid)
                        <a href="{{ route('stripe.checkout', ['id' => $pub->id]) }}"
                           class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">
                           💳 Payer
                        </a>
                    @endif
                
                    {{-- Supprimer --}}
                    <form method="POST" action="{{ route('admin.publicites.supprimer', $pub->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                            ❌ Supprimer
                        </button>
                    </form>
                </td>
                
@endforeach

            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#pubCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Précédent</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#pubCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Suivant</span>
            </button>
        </div>
    @endif
</div>
@endsection
