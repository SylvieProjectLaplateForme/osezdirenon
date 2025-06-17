@extends('editeur.layout')


@section('title', 'Soumettre une publicité')


@section('content')
    <div class="max-w-2xl mx-auto bg-white p-8 rounded shadow mt-10">
        <h1 class="text-2xl font-bold mb-6">Soumettre une publicité</h1>


        @if (session('success'))
            <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif


        <form action="{{ route('publicite.store') }}" method="POST" enctype="multipart/form-data">
            @csrf


            <div class="mb-4">
                <label for="titre" class="block font-semibold mb-1">Titre *</label>
                <input type="text" name="titre" id="titre" value="{{ old('titre') }}"
                    class="w-full border border-gray-300 rounded px-4 py-2" required>
                @error('titre')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div class="mb-4">
                <label for="lien" class="block font-semibold mb-1">Lien *</label>
                <input type="url" name="lien" id="lien" value="{{ old('lien') }}"
                    class="w-full border border-gray-300 rounded px-4 py-2" required>
                @error('lien')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            <div class="mb-4">
                <label for="image" class="block font-semibold mb-1">Image</label>
                <input type="file" name="image" id="image" class="w-full border border-gray-300 rounded px-4 py-2">
                @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>


            @php
                use Carbon\Carbon;

                Carbon::setLocale('fr');

                $defaultDateDebut = old('date_debut', now()->format('Y-m-d'));
                $dateFin = Carbon::parse($defaultDateDebut)->addMonth();
                $defaultDateFin = $dateFin->translatedFormat('d F Y'); // ex : 11 juin 2025
            @endphp


            <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="date_debut" class="block font-semibold mb-1">Date de début</label>
                    <input type="date" name="date_debut" id="date_debut"
                        class="w-full border border-gray-300 rounded px-4 py-2" value="{{ $defaultDateDebut }}">
                    @error('date_debut')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div>
                    <label class="block font-semibold mb-1">Date de fin (automatique)</label>
                    <input type="text" class="w-full border border-gray-300 rounded px-4 py-2 bg-gray-100"
                        value="{{ $defaultDateFin }}" readonly>
                </div>
            </div>



            {{-- <div>
                <label for="date_debut" class="block font-semibold mb-1">Date de début</label>
                <input type="date" name="date_debut" id="date_debut"
                    class="w-full border border-gray-300 rounded px-4 py-2">
                @error('date_debut')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div> --}}
            {{-- <div>
                <label for="date_fin" class="block font-semibold mb-1">Date de fin</label>
                <input type="date" name="date_fin" id="date_fin"
                    class="w-full border border-gray-300 rounded px-4 py-2">
                @error('date_fin')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div> --}}
            <div class="pt-4">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
                    🚀 Soumettre la publicité
                </button>

            </div>
    </div>


    </form>
    </div>
@endsection
