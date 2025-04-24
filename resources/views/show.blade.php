@extends('layout')

@section('title', $article->title)

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 shadow rounded-lg mt-10">
    <div class="text-center mb-6">
        <h1 class="text-4xl font-bold text-gray-800">{{ $article->title }}</h1>
        <p class="text-sm text-gray-500 mt-2">
            Publié par <strong>{{ $article->user->name }}</strong>
            • {{ $article->created_at->format('d/m/Y') }}
        </p>
    </div>

    @if ($article->image)
    <div class="w-full h-[350px] overflow-hidden rounded-lg shadow mb-6">
        <img src="{{ asset('storage/' . $article->image) }}"
             alt="{{ $article->title }}"
             class="w-full h-full object-cover object-center">
    </div>
@endif


<p class="text-center mb-6">
    <span class="inline-block px-4 py-1 text-sm font-semibold rounded-full {{ $article->category->color_class }} animate-bounce">
        {{ $article->category->name }}
    </span>
</p>


<div class="prose lg:prose-lg max-w-none text-justify text-gray-800 leading-relaxed">
    {!! nl2br(e($article->content)) !!}
</div>


    <div class="mt-10 text-center">
        <a href="{{ route('home') }}" class="text-blue-600 hover:underline">
            ← Retour à l'accueil
        </a>
    </div>
</div>
@endsection
