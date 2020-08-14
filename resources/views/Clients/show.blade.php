@extends("layouts.app")

@section('content')
<p>{{ $client['name'] }} <a class="btn bg-primary text-white" href="{{ route('clients.edit', ['client' => $client['id']]) }}">{{__('edit')}}</a></p>
<div>
    <div>{{ $client['address'] }}</div>
    <div>{{ $client['email'] }}</div>
    <div>{{ $client['phone'] }}</div>
    <div class="pt-4">{{ $client['notes'] }}</div>
</div>

<div>
    <p>Reservations:</p>
    @foreach ( $reservations as $reservation )
        <div>
            <p><a class="btn 
@switch($reservation['status'])
    @case('Partially paid')
            bg-warning text-dark
        @break

    @case('Fully paid')
            bg-success
        @break

    @case('Not paid')
            bg-danger
        @break

    @case('Cancelled')
            bg-secondary
        @break

    @default
        bg-primary
@endswitch
             text-white" href="{{ route('reservations.show', $reservation['id']) }}">{{ $reservation['status'] }} - {{ date('Y-m-d', $reservation['start_date']) }} - {{ date('Y-m-d', $reservation['end_date']) }}</a></p>
        </div>
    @endforeach
</div>
@endsection