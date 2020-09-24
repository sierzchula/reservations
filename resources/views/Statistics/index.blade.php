@extends("layouts.app")

@section("content")

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('statistics.index') }}" autocomplete="off">
        @csrf
    <div class="d-flex flex-row">
        <div class="form-group">
            <label for="start_date">{{__('Początek')}}:</label>
            <div id="start_date_show" date="{{ date('m/d/Y', $start_date) }}"></div>
            <input name="start_date" value="{{ date('m/d/Y', $start_date) }}" type="hidden" required class="form-control" id="start_date">
        </div>
        <div class="form-group">
            <label for="end_date">{{__('Koniec')}}:</label>
            <div id="end_date_show" date="{{ date('m/d/Y', $end_date) }}"></div>
            <input name="end_date" value="{{ date('m/d/Y', $end_date) }}" type="hidden" required class="form-control" id="end_date">
        </div>
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary mb-2" value="{{__('szukaj')}}" />
    </div>
</form>

@if ( isset($stats) )
    <div class="container" style="width: 1110px !important;max-width: 1110px !important;">
        <div class="row">
            <div class="col border text-center">Apartamenty</div>
            <div class="col alert-dark text-center border">Rezerwacje</div>
            <div class="col alert-dark text-center border">Suma dni</div>
            <div class="col alert-dark text-center border">Wpływy</div>
            <div class="col alert-dark text-center border">Zaległości</div>
            <div class="col alert-dark text-center border">Suma należności</div>
            <div class="col alert-dark text-center border">Obłożenie</div>
        </div>
    @foreach ( $apartments as $apartment )
        <div class="row">
            <div class="col alert-dark text-right border">{{ $apartment['name'] }}</div>
            <div class="col text-center border @if ( $apartment['total_reservations'] == 0 ) text-light @endif">{{ $apartment['total_reservations'] }}</div>
            <div class="col text-center border @if ( $apartment['total_reservations'] == 0 ) text-light @endif">{{ $apartment['days_reserved'] }}</div>
            <div class="col text-center border @if ( $apartment['total_reservations'] == 0 ) text-light @endif @if ( $apartment['total_paid'] < $apartment['total_income'] ) text-danger @elseif ( $apartment['total_paid'] != 0 ) text-success @endif">{{ round( $apartment['total_paid'], 2) }}</div>
            <div class="col text-center border @if ( $apartment['total_reservations'] == 0 ) text-light @endif @if ( $apartment['total_paid'] < $apartment['total_income'] ) text-danger @elseif ( $apartment['total_paid'] != 0 ) text-success @endif">{{ round( $apartment['payments_left'], 2 ) }}</div>
            <div class="col text-center border @if ( $apartment['total_reservations'] == 0 ) text-light @endif @if ( $apartment['total_paid'] < $apartment['total_income'] ) text-danger @elseif ( $apartment['total_paid'] != 0 ) text-success @endif">{{ round( $apartment['total_income'], 2 ) }}</div>
            <div class="col text-center border @if ( $apartment['total_reservations'] == 0 ) text-light @endif">{{ ($apartment['total_income']) ? round($apartment['days_reserved'] / $stats['count_available_days'] * 100) : 0 }}%</div>
        </div>
    @endforeach
        <div class="row">
            <div class="col alert-dark text-center border">SUMA</div>
        </div>
        <div class="row">
            <div class="col border text-center">Apartamentów: {{ $stats['count_apartments'] }}<br>(z rezerwacją: {{ $stats['total_reserved_apartments'] }})</div>
            <div class="col text-center border">{{ $stats['overlapping']+$stats['internal'] }}</div>
            <div class="col text-center border">{{ $stats['count_reserved_days'] }}<br>(średnia: {{ $stats['average_length_of_reservation'] }})</div>
            <div class="col text-center border">{{ round( $stats['estimated_prepaid_value'], 2) }}</div>
            <div class="col text-center border">{{ round( $stats['payments_left'], 2) }}</div>
            <div class="col text-center border">{{ round( $stats['estimated_total_income'], 2) }}</div>
            <div class="col text-center border">{{ round($stats['percent_of_rent']) }}%</div>
        </div>
    </div>
@endif

@endsection