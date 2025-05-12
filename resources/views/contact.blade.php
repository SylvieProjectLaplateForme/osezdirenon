@extends('layout')

@section('title', 'Contact')

@section('content')

@if (session('success'))
    <div class="bg-green-200 text-green-800 p-4 rounded mb-6 text-center">
        {{ session('success') }}
    </div>
@endif

<div class="flex justify-center items-center min-h-screen">
    <div class="w-full max-w-lg bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-2xl font-bold text-center mb-6">Contactez-nous</h2>

        <form action="{{ route('contact.envoyer') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Nom</label>
                <input type="text" name="name" id="name" required
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" required
                       class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <div>
                <label for="message" class="block mb-2 text-sm font-medium text-gray-700">Message</label>
                <textarea name="message" id="message" rows="5" required
                          class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"></textarea>
            </div>

            <div class="text-center mt-6">
                <button type="submit"
                        class="bg-blue-500 text-white font-bold py-3 px-6 rounded-lg hover:bg-blue-600 transition">
                    Envoyer
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
