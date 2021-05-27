<div class="col-md-3 e-ticket-in-profile rounded border pb-3">
    <a href="/ticket/{{ $ticket->uid }}">
        <div class="e-qr-profile">
            {!! QrCode::size(250)->generate($ticket->uid); !!}
        </div>
        <hr class="mb-1">
        <h4 class="mb-5">{{ $ticket->uid }}<br>
            <span class="mt-2 mb-5 text-muted text-center">
                {{ $ticket->departureDate->format('d/m/Y') }} @if($ticket->willReturn) - {{ $ticket->returnDate->format('d/m/Y') }} @endif
            </span>
        </h4>
    </a>
</div>
