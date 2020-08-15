@extends("layouts.app")

@section("content")
<p>reservations - <a href="{{ route('reservations.create') }}">add new</a></p>
<div class="d-flex flex-row">
    <div class="" style="margin-right:300px"></div>
        @for($i=0;$i<=31;$i++)
            <div class="btn" style="min-width:34px">{{$i}}</div>
        @endfor
</div>

<div class="d-flex">
    <div class="d-flex flex-column">
        @foreach ( $reservations as $key =>$reservations_aparment )
            <div class="p-2 no-wrap border border-dark" style="width:300px;white-space: nowrap;background:white">{{ $key }}</div>
        @endforeach
    </div>
    <div class="d-flex flex-column" style="position:relative;background-size: 34px 40px;background-image:linear-gradient(to right, grey 1px, transparent 1px),linear-gradient(to bottom, grey 1px, transparent 1px);">
        @foreach ( $reservations as $key =>$reservations_aparment )
            <div class="d-flex flex-nowrap p-1" style="position:relative;width:{{32*34}}px;height:40px">

                @foreach ( $reservations_aparment as $reservation)
                    @if ( $reservation['days'] > 0 )
                        <a 
                            title="{{date('Y-m-d',$reservation['start_date'])}} - {{date('Y-m-d',$reservation['end_date'])}}" 
                            href="{{ route('reservations.show', $reservation['id']) }}" 
                            class="border border-dark p-1 btn
                            @switch($reservation['status'])
                                @case('Partially paid')
                                        bg-warning text-dark
                                    @break

                                @case('Fully paid')
                                        bg-success text-white
                                    @break

                                @case('Not paid')
                                        bg-danger text-white
                                    @break

                                @case('Cancelled')
                                        bg-secondary text-white
                                    @break

                                @default
                                    bg-primary text-white
                            @endswitch
                        " style="height:34px;position:absolute;left: {{ 20 + date('d', $reservation['start_date']) * 34 }}px;width: {{ $reservation['days'] * 34 }}px">{{ $reservation['days'] }}</a>
                    @endif
                @endforeach
            </div>

        @endforeach
    </div>
</div>

<div class="d-flex flex-column no-wrap" style="background-position: -21px 1px;background-size: 40px 48px;background-image:linear-gradient(to right, grey 1px, transparent 1px),linear-gradient(to bottom, grey 1px, transparent 1px);">
   
    @foreach ( $reservations as $key =>$reservations_aparment )
    
        
            
                
                
        </div>
    @endforeach
   
</div>
@endsection