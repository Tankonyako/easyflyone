<div class="e-new-flight col-md-3 position-relative">
    @if(!is_null($newFlight->image))
        <img src="{{ $newFlight->image }}" width="100%">
    @endif
    <h4 class="text-center mt-1 mb-1">{{ $newFlight->name }}</h4>
    @if(!is_null($newFlight->description))
        <p class="text-center mt-0 mb-1">{{ $newFlight->description }}</p>
    @endif
    <a class="btn btn-warning w-100 mt-1" href="http://localhost:3000/startbook/{{ $newFlight->originIata }}/{{ $newFlight->destinationIata }}">Start booking - {{ $newFlight->price }} €</a>
    @if($user && $user->isAdmin())
        <form method="POST" action="/acp/remove/new_flights">
            @csrf
            <input type="hidden" name="id" value="{{ $newFlight->id }}">
            <button type="submit" class="btn btn-danger btn-sm mt-1 mx-auto">Delete</button>
        </form>
    @endif
</div>
