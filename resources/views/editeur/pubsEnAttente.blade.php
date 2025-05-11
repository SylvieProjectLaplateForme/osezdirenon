@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">Mes publicités en attente</h1>

@if($publicites->count())
    <ul>
        @foreach($publicites as $pub)
            <li class="mb-2">
                <strong>{{ $pub->titre }}</strong> – {{ $pub->created_at->format('d/m/Y') }}
            </li>
        @endforeach
    </ul>
@else
    <p>Aucune publicité en attente.</p>
@endif
@endsection
