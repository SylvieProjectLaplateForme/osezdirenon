@extends('admin.layout')

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


{{-- <div class="prose lg:prose-lg max-w-none text-justify text-gray-800 leading-relaxed">
    {!! nl2br(e($article->content)) !!}
</div> --}}
{{-- ✅ CONTENU FORMATÉ --}}
<div class="prose max-w-none mb-12 bg-white p-6 rounded shadow">
    @foreach (explode("\n", $article->content) as $paragraph)
        @if (trim($paragraph) !== '')
            <p>{{ $paragraph }}</p>
        @endif
    @endforeach
</div>



@if (!$article->is_approved)
    <form action="{{ route('admin.articles.validate', $article->id) }}" method="POST" class="mt-6 text-center">
        @csrf
        @method('PUT')
        <button type="submit" class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700">
            ✅ Valider cet article
        </button>
    </form>
@endif


    <div class="mt-10 text-center">
        <a href="{{ route('home') }}" class="text-blue-600 hover:underline">
            ← Retour à l'accueil
        </a>
    </div>
</div>
@endsection
