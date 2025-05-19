@php
    $publicites = \App\Models\Publicite::where('is_approved', true)
        ->where('paid', true)
        ->where(function($q){
            $q->whereNull('date_debut')->orWhere('date_debut', '<=', now());
        })
        ->where(function($q){
            $q->whereNull('date_fin')->orWhere('date_fin', '>=', now());
        })
        ->latest()
        ->take(6)
        ->get();
@endphp

@if($publicites->count())
    <div class="bg-gray-100 py-8 px-4 rounded-lg shadow-inner mb-10">
        <h2 class="text-center text-lg font-bold text-pink-600 mb-6">
            💗 Publicités partenaires
            <span class="relative group ml-2 inline-block">
                <svg class="w-4 h-4 text-pink-400 cursor-pointer inline" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 7h2v2H9V7zm1-5a9 9 0 100 18A9 9 0 0010 2zm0 16a7 7 0 110-14 7 7 0 010 14z"/>
                </svg>
                <span class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 w-52 px-3 py-2 text-white bg-pink-600 text-xs rounded shadow-md opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-50 text-center">
                    Publicités validées et payées.<br>
                    <a href="{{ route('editeur.publicites.create') }}" class="underline text-pink-200 hover:text-white">
                        Créer la vôtre 💖
                    </a>
                </span>
            </span>
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach($publicites as $pub)
                <a href="{{ $pub->lien }}" target="_blank"
                   class="bg-white rounded-xl shadow group overflow-hidden transition transform hover:-translate-y-1 hover:shadow-xl flex flex-col text-center">

                    @if($pub->image)
                        <div class="overflow-hidden h-32">
                            <img src="{{ asset('storage/' . $pub->image) }}"
                                 alt="{{ $pub->titre }}"
                                 class="h-full w-full object-contain group-hover:scale-110 transition-transform duration-500">
                        </div>
                    @endif

                    <div class="p-4 flex-1 flex flex-col justify-between">
                        <h3 class="text-pink-700 font-semibold text-sm mb-2 group-hover:underline">
                            {{ $pub->titre }}
                        </h3>
                        <span class="text-pink-600 font-bold text-sm group-hover:text-pink-800">
                            Visiter →
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
@endif
