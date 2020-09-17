@extends("layouts.app")

@section('content')
<p>{{ $client['name'] }} <a class="btn bg-primary text-white" href="{{ route('clients.edit', ['client' => $client['id']]) }}">{{__('edytuj')}}</a></p>
<div>
    <div>{{ $client['address'] }}</div>
    <div>{{ $client['email'] }}</div>
    <div>{{ $client['phone'] }}</div>
    <div class="pt-4">{{ $client['notes'] }}</div>
</div>

<div>
    <p>Rezerwacje:</p>
    @foreach ( $reservations as $reservation )
        <div>
            <p>
@switch($reservation['status'])
    @case('Partially paid')
        <a class="btn  bg-warning text-dark" href="{{ route('reservations.edit', $reservation['id']) }}">Wpłacona zaliczka - {{ date('Y-m-d', $reservation['start_date']) }} - {{ date('Y-m-d', $reservation['end_date']) }}</a>
        @break

    @case('Fully paid')
        <a class="btn bg-success text-white" href="{{ route('reservations.edit', $reservation['id']) }}">Zapłacono - {{ date('Y-m-d', $reservation['start_date']) }} - {{ date('Y-m-d', $reservation['end_date']) }}</a>
        @break

    @case('Not paid')
        <a class="btn bg-danger text-white" href="{{ route('reservations.edit', $reservation['id']) }}">Brak wpłaty - {{ date('Y-m-d', $reservation['start_date']) }} - {{ date('Y-m-d', $reservation['end_date']) }}</a>
        @break

    @case('Cancelled')
        <a class="btn bg-primary text-white" href="{{ route('reservations.edit', $reservation['id']) }}">Płatność Booking - {{ date('Y-m-d', $reservation['start_date']) }} - {{ date('Y-m-d', $reservation['end_date']) }}</a>
        @break

    @default
        <a class="btn bg-secondary text-white" href="{{ route('reservations.edit', $reservation['id']) }}">Niedostępny - {{ date('Y-m-d', $reservation['start_date']) }} - {{ date('Y-m-d', $reservation['end_date']) }}</a>
@endswitch
            </p>
        </div>
    @endforeach
</div>
@endsection