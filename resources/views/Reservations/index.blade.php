@extends("layouts.app")

@section("content")
<p>reservations - {{date('m/Y', time())}} - <a href="{{ route('reservations.create') }}">add new</a></p>
<div class="d-flex flex-row">
    <div class="" style="margin-right:150px"></div>
        @for($i=1;$i<=31;$i++)
            <div class="" style="width:30px;text-align:center;
                @if ( $i == date('d', time()) ) 
                    font-weight: 700;color:red;
                @endif
            ">{{$i}}</div>
        @endfor
</div>

<div class="d-flex">
    <div class="d-flex flex-column">
        @foreach ( $reservations as $key =>$reservations_aparment )
            <div class="p-2 no-wrap border border-dark" style="width:150px;white-space: nowrap;background:white;height:41px;overflow:hidden" title="{{ $key }}">{{ $key }}</div>
        @endforeach
    </div>
    <div class="d-flex flex-column" style="overflow: hidden;position:relative;background-size: 30px 41px;background-image:linear-gradient(to right, grey 1px, transparent 1px),linear-gradient(to bottom, grey 1px, transparent 1px);">
        @foreach ( $reservations as $key =>$reservations_aparment )
            <div class="d-flex flex-nowrap p-1" style="position:relative;width:{{31*30}}px;height:41px">

                @foreach ( $reservations_aparment as $reservation)
                    @if ( $reservation['days'] > 0 )
                        <a 
                            title="{{date('Y-m-d',$reservation['start_date'])}} - {{date('Y-m-d',$reservation['end_date'])}}" 
                            href="{{ route('reservations.edit', $reservation['id']) }}" 
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
                        " style="height:34px;position:absolute; 
                        @if ( date('m', $reservation['start_date']) == date('m', time() ) )
                            left: {{ -15 + date('d', $reservation['start_date']) * 30 }}px;
                        @elseif ( date('m', $reservation['end_date']) == date('m', time() ) )
                        left: {{ -15 + date('d', $reservation['end_date']) * 30 - $reservation['days'] * 30 }}px;
                        @else
                           
                        @endif

                        width: {{ $reservation['days'] * 30 }}px">{{ $reservation['days'] }}</a>
                    @endif
                @endforeach
            </div>

        @endforeach
    </div>
</div>

<div class="d-flex flex-column no-wrap" style="background-position: -21px 1px;background-size: 40px 48px;background-image:linear-gradient(to right, grey 1px, transparent 1px),linear-gradient(to bottom, grey 1px, transparent 1px);">
   
    @foreach ( $reservations as $key =>$reservations_aparment )
    
        
            
                
                
        
    @endforeach
   
</div>
@endsection