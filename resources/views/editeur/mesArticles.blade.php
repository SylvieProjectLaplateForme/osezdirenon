@extends('layout')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">📋 Mes Articles</h1>

    @if($articles->isEmpty())
        <p>Aucun article trouvé.</p>
    @else
        <table class="min-w-full bg-white border rounded shadow">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="py-3 px-4">Titre</th>
                    <th class="py-3 px-4">Date</th>
                    <th class="py-3 px-4">Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($articles as $article)
                    <tr>
                        <td class="py-2 px-4">{{ $article->title }}</td>
                        <td class="py-2 px-4">{{ $article->created_at->format('d/m/Y') }}</td>
                        <td class="py-2 px-4">
                            @if ($article->is_approved)
                                <span class="text-green-600">Validé</span>
                            @else
                                <span class="text-yellow-600">En attente</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6">
            {{ $articles->links() }}
        </div>
    @endif
</div>
@endsection

