@extends("layouts.app")

@section("content")
<p>reservations - <a href="{{ route('reservations.create') }}">add new</a></p>

<div class="d-flex flex-column">
   
    @foreach ( $reservations as $reservation )
    <div class="p-1">
        <a class="btn bg-primary text-white" href="{{ route('reservations.show', ['reservation' => $reservation['id']]) }}">{{ $reservation['name'] }} ( {{ date( 'Y-m-d', $reservation['start_date']) }} - {{ date( 'Y-m-d', $reservation['end_date']) }} / {{ $reservation['days']}} )</a>
    </div>
    @endforeach
   
</div>
@endsection