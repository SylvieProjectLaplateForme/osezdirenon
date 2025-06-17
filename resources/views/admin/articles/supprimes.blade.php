@extends('admin.layout')

@section('title', 'Articles supprimés')

@section('content')
    <h1 class="text-2xl font-bold mb-6">🗑️ Articles supprimés </h1>

    @if (session('success'))
        <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-6 shadow">
            {{ session('success') }}
        </div>
    @endif

    @if ($articles->isEmpty())
        <p class="text-gray-600">Aucun article supprimé.</p>
    @else
        <table class="min-w-full bg-white shadow rounded">
            <thead class="bg-pink-100">
                <tr>
                    <th class="px-4 py-2 text-left">Titre</th>
                    <th class="px-4 py-2 text-left">Supprimé le</th>
                    <th class="px-4 py-2 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $article->title }}</td>
                        <td class="px-4 py-2 text-sm text-gray-500">
                            {{ $article->deleted_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-4 py-2 flex gap-2">
                            {{-- 🔁 Restaurer --}}
                            <form method="POST" action="{{ route('admin.articles.restaurer', $article->id) }}">
                                @csrf
                                @method('PUT')
                                <button class="text-green-600 hover:underline" onclick="return confirm('Restaurer cet article ?')">
                                    ♻ Restaurer
                                </button>
                            </form>

                            {{-- ❌ Suppression définitive
                            <form method="POST" action="{{ route('admin.articles.forceDelete', $article->id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline" onclick="return confirm('Supprimer définitivement ?')">
                                    🗑 Supprimer Déf.
                                </button>
                            </form> --}}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <div class="mt-6">
        <a href="{{ route('admin.articles.index') }}" class="text-blue-600 hover:underline">
            ← Retour à la liste des articles
        </a>
    </div>
@endsection
