@extends("layouts.app")

@section("content")
<p>reservations - <a href="{{ route('reservations.create') }}">add new</a></p>

<div class="d-flex flex-column">
   
    @foreach ( $reservations as $key =>$reservations_aparment )
    
        <div class="d-flex flex-nowrap p-2">
            <div class="p-1" style="width:200px">{{ $key }}</div>
            @foreach ( $reservations_aparment as $reservation)
                <div class="p-1 btn bg-success" style="width: {{ $reservation['days'] * 40 }}px"> {{ $reservation['days'] }}d </div>
            @endforeach
        </div>

    @endforeach
   
</div>
@endsection