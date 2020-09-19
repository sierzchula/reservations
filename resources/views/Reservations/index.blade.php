@extends("layouts.app")

@section("content")
<p>Rezerwacje</p>
<div style="width:1110px !important">
    <div class="d-flex justify-content-between w-100">
        <a class="d-flex" href="{{ route('reservations.indexdate', [ date("Y", strtotime( request()->route('month') . "/15/" . request()->route('year') . " -3 month") ), date("m", strtotime( request()->route('month') . "/15/" . request()->route('year') . " -3 months") )]) }}"> {{ date("Y/m", strtotime( request()->route('month') . "/15/" . request()->route('year') . " -3 months") ) }}</a>
        <a class="d-flex" href="{{ route('reservations.indexdate', [ date("Y", strtotime( request()->route('month') . "/15/" . request()->route('year') . " -2 month") ), date("m", strtotime( request()->route('month') . "/15/" . request()->route('year') . " -2 months") )]) }}"> {{ date("Y/m", strtotime( request()->route('month') . "/15/" . request()->route('year') . " -2 months") ) }}</a>
        <a class="d-flex" href="{{ route('reservations.indexdate', [ date("Y", strtotime( request()->route('month') . "/15/" . request()->route('year') . " -1 month") ), date("m", strtotime( request()->route('month') . "/15/" . request()->route('year') . " -1 month") )]) }}"> {{ date("Y/m", strtotime( request()->route('month') . "/15/" . request()->route('year') . " -1 month") ) }}</a>
        <a class="d-flex font-weight-bold" style="font-size:20px" href="{{ route('reservations.indexdate', [ date("Y", strtotime( request()->route('month') . "/15/" . request()->route('year') . " -1 month") ), date("m", strtotime( request()->route('month') . "/15/" . request()->route('year') ) )]) }}"> {{ date("Y/m", strtotime( request()->route('month') . "/15/" . request()->route('year') ) ) }}</a>
        <a class="d-flex" href="{{ route('reservations.indexdate', [ date("Y", strtotime( request()->route('month') . "/15/" . request()->route('year') . " +1 month") ), date("m", strtotime( request()->route('month') . "/15/" . request()->route('year') . " +1 month") )]) }}"> {{ date("Y/m", strtotime( request()->route('month') . "/15/" . request()->route('year') . " +1 month") ) }}</a>
        <a class="d-flex" href="{{ route('reservations.indexdate', [ date("Y", strtotime( request()->route('month') . "/15/" . request()->route('year') . " +2 month") ), date("m", strtotime( request()->route('month') . "/15/" . request()->route('year') . " +2 months") )]) }}"> {{ date("Y/m", strtotime( request()->route('month') . "/15/" . request()->route('year') . " +2 months") ) }}</a>
        <a class="d-flex" href="{{ route('reservations.indexdate', [ date("Y", strtotime( request()->route('month') . "/15/" . request()->route('year') . " +3 month") ), date("m", strtotime( request()->route('month') . "/15/" . request()->route('year') . " +3 months") )]) }}"> {{ date("Y/m", strtotime( request()->route('month') . "/15/" . request()->route('year') . " +3 months") ) }}</a>
    </div>

    <div class="d-flex flex-row">
        <div class="" style="margin-right:150px"></div>
            @for($i=1;$i<=date('t', strtotime( request()->route('month') . "/01/" . request()->route('year') ));$i++)
                <div class="" style="width:30px;text-align:center;
                    @if ( $i == date('d', time()) && date('m', time()) == request()->route('month') ) 
                        font-weight: 700;color:red;
                    @elseif ( date( 'N', strtotime( request()->route('month') . "/" . $i . "/" . request()->route('year') ) ) >= 6 ) 
                        font-weight: 700;color:blue;background-color:#ddd;
                    @endif
                ">{{$i}}</div>
            @endfor
    </div>
    <div class="d-flex" style="background-position-x: {{90 - ( ( $day_of_the_week - 1 ) * 30 )}}px;background-size: 210px;background-image: linear-gradient(to right, #ddd 0px, #ddd 60px, transparent 60px);">
        <div class="d-flex flex-column">
            @foreach ( $reservations as $key =>$reservations_aparment )
                <div class="p-2 no-wrap border border-dark" style="width:150px;white-space: nowrap;background:white;height:41px;overflow:hidden" title="{{ $key }}">
                    <a href="{{ route('reservations.create', $reservations_aparment['apartment_id']) }}">(dodaj)</a>
                    {{ $key }} 
                </div>
            @endforeach
        </div>
        <div class="d-flex flex-column" style="overflow: hidden;position:relative;background-size: 30px 41px;background-image:linear-gradient(to right, grey 1px, transparent 1px),linear-gradient(to bottom, grey 1px, transparent 1px);">
            @foreach ( $reservations as $key =>$reservations_aparment )
                <div class="d-flex flex-nowrap p-1" style="position:relative;width:{{31*30}}px;height:41px">

                    @foreach ( $reservations_aparment as $reservation)
                        @if ( gettype( $reservation ) == 'object' )
                            <a 
                                title="{{$reservation['client_data']['name']}} - {{date('Y-m-d',$reservation['start_date'])}} - {{date('Y-m-d',$reservation['end_date'])}}" 
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
                                            bg-primary text-white
                                        @break

                                    @default
                                        bg-secondary text-white
                                @endswitch
                            " style="overflow:hidden;height:34px;position:absolute; 
                            @if ( date('m', $reservation['start_date']) == request()->route('month') )
                                left: {{ -15 + date('d', $reservation['start_date']) * 30 }}px;
                            @elseif ( date('m', $reservation['end_date']) == request()->route('month') )
                            left: {{ -15 + date('d', $reservation['end_date']) * 30 - $reservation['days'] * 30 }}px;
                            @else
                            
                            @endif

                            width: {{ $reservation['days'] * 30 }}px">{{ $reservation['client_data']['name'] }}</a>
                        @endif
                    @endforeach
                </div>

            @endforeach
        </div>
    </div>
</div>
@endsection