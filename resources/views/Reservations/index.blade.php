@extends("layouts.app")

@section("content")
<p>reservations</p>

<div class="d-flex justify-content-between w-100">
    <a class="d-flex" href="{{ route('reservations.indexdate', [ date("Y", strtotime( request()->route('month') . "/15/" . request()->route('year') . " -3 month") ), date("m", strtotime( request()->route('month') . "/15/" . request()->route('year') . " -3 months") )]) }}"> {{ date("Y/m", strtotime( request()->route('month') . "/15/" . request()->route('year') . " -3 months") ) }}</a>
    <a class="d-flex" href="{{ route('reservations.indexdate', [ date("Y", strtotime( request()->route('month') . "/15/" . request()->route('year') . " -2 month") ), date("m", strtotime( request()->route('month') . "/15/" . request()->route('year') . " -2 months") )]) }}"> {{ date("Y/m", strtotime( request()->route('month') . "/15/" . request()->route('year') . " -2 months") ) }}</a>
    <a class="d-flex" href="{{ route('reservations.indexdate', [ date("Y", strtotime( request()->route('month') . "/15/" . request()->route('year') . " -1 month") ), date("m", strtotime( request()->route('month') . "/15/" . request()->route('year') . " -1 month") )]) }}"> {{ date("Y/m", strtotime( request()->route('month') . "/15/" . request()->route('year') . " -1 month") ) }}</a>
    <a class="d-flex font-weight-bold" href="{{ route('reservations.indexdate', [ date("Y", strtotime( request()->route('month') . "/15/" . request()->route('year') . " -1 month") ), date("m", strtotime( request()->route('month') . "/15/" . request()->route('year') ) )]) }}"> {{ date("Y/m", strtotime( request()->route('month') . "/15/" . request()->route('year') ) ) }}</a>
    <a class="d-flex" href="{{ route('reservations.indexdate', [ date("Y", strtotime( request()->route('month') . "/15/" . request()->route('year') . " +1 month") ), date("m", strtotime( request()->route('month') . "/15/" . request()->route('year') . " +1 month") )]) }}"> {{ date("Y/m", strtotime( request()->route('month') . "/15/" . request()->route('year') . " +1 month") ) }}</a>
    <a class="d-flex" href="{{ route('reservations.indexdate', [ date("Y", strtotime( request()->route('month') . "/15/" . request()->route('year') . " +2 month") ), date("m", strtotime( request()->route('month') . "/15/" . request()->route('year') . " +2 months") )]) }}"> {{ date("Y/m", strtotime( request()->route('month') . "/15/" . request()->route('year') . " +2 months") ) }}</a>
    <a class="d-flex" href="{{ route('reservations.indexdate', [ date("Y", strtotime( request()->route('month') . "/15/" . request()->route('year') . " +3 month") ), date("m", strtotime( request()->route('month') . "/15/" . request()->route('year') . " +3 months") )]) }}"> {{ date("Y/m", strtotime( request()->route('month') . "/15/" . request()->route('year') . " +3 months") ) }}</a>
</div>

<div class="d-flex flex-row">
    <div class="" style="margin-right:150px"></div>
        @for($i=1;$i<=date('t', strtotime( request()->route('month') . "/01/" . request()->route('year') ));$i++)
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
            <div class="p-2 no-wrap border border-dark" style="width:150px;white-space: nowrap;background:white;height:41px;overflow:hidden" title="{{ $key }}">
                <a href="{{ route('reservations.create', $reservations_aparment['apartment_id']) }}">(add)</a>
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
                        @if ( date('m', $reservation['start_date']) == request()->route('month') )
                            left: {{ -15 + date('d', $reservation['start_date']) * 30 }}px;
                        @elseif ( date('m', $reservation['end_date']) == request()->route('month') )
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
  
@endsection