@extends('admin.layout')


@section('content')
{{-- affiche message success de admincontroller --}}
@if(session('success'))
    <div class="bg-green-200 text-green-800 px-4 py-3 rounded mb-6 text-center">
        {{ session('success') }}
    </div>
@endif

<div class="max-w-6xl mx-auto py-10 px-4">
    <h1 class="text-2xl font-bold text-pink-600 mb-6">📝 Mes articles</h1>

    @if ($articles->count())
        <div class="overflow-x-auto">
            <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-200 text-gray-700 text-sm uppercase">
                    <tr>
                        <th class="px-4 py-3 text-left">Titre</th>
                        <th class="px-4 py-3 text-left">Catégorie</th>
                        <th class="px-4 py-3 text-left">Créé le</th>
                        <th class="px-4 py-3 text-left">Statut</th>
                        <th class="px-4 py-3 text-left">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 text-sm">
                    @foreach ($articles as $article)
                        <tr class="border-b">
                            <td class="px-4 py-3 font-semibold">{{ $article->title }}</td>
                            <td class="px-4 py-3">{{ $article->category->name ?? 'Non classé' }}</td>
                            <td class="px-4 py-3">{{ $article->created_at->format('d/m/Y') }}</td>
                            <td class="px-4 py-3">
                                @if($article->is_approved)
                                    <span class="text-green-600 font-semibold">✅ Validé</span>
                                @else
                                    <span class="text-yellow-600 font-semibold">⏳ En attente</span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <a href="{{ route('admin.articles.edit', $article->id) }}"
                                   class="text-blue-600 hover:underline font-medium text-sm">✏️ Modifier</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $articles->links() }}
        </div>
    @else
        <p class="text-gray-600">Vous n’avez rédigé aucun article pour le moment.</p>
    @endif
</div>
@endsection

