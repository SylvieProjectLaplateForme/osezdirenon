@props(['title', 'value', 'route'])

<div class="bg-white rounded shadow p-4 text-center">
    <h2 class="text-lg font-semibold mb-1">{{ $title }}</h2>
    <p class="text-2xl font-bold">{{ $value }}</p>
    <a href="{{ route($route) }}" class="text-blue-500 hover:underline">Voir</a>
</div>
