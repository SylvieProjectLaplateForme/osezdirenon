@if (Route::has('cookie.consent'))
    <form action="{{ route('cookie.consent') }}" method="POST" class="inline">
        @csrf
        <button type="submit" class="underline ml-2">J’accepte</button>
    </form>
@endif
