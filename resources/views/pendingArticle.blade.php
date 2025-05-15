@extends('admin.layout')

@section('title', 'Articles en attente')

@section('content')
@if ($articles->isEmpty())
    <p>Aucun article en attente.</p>
@else
    <ul class="space-y-4">
        @foreach ($articles as $article)
            <li class="border p-4 rounded shadow bg-white">
                <h2 class="font-semibold">{{ $article->title }}</h2>
                <p class="text-sm text-gray-600">Par : {{ $article->user->name }}</p>
                <a href="{{ route('admin.articles.show', $article->id) }}" class="text-blue-600 hover:underline">
                    ➔ Voir l’article
                </a>
            </li>
        @endforeach
    </ul>
@endif
@endsection
