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

<div>
    @if ( $stats )

    <div>Ilość rezerwacji: {{ $stats['overlapping']+$stats['internal'] }}</div>
    <div>Sięgające poza okres: {{$stats['overlapping']}}</div>
    <div>Mieszczące się w okresie: {{ $stats['internal'] }}</div>

    <div>Całkowita liczba możliwych dni rezerwacji na apartament: {{ $stats['count_available_days'] }}</div>
    <div>Ilość apartmentów: {{ $stats['count_apartments'] }}</div>
    <div>Teoretyczna ilość dni rezerwacji: {{ $stats['total_possible_days_of_rent'] }}
    <div>Apartamenty posiadające rezerwacje: {{ $stats['total_reserved_apartments'] }}</div>
    <div>Ilość dni rezerwacji: {{ $stats['count_reserved_days'] }}</div>

    <div>Wartość rezerwacji: {{ $stats['estimated_total_income'] }}</div>
    <div>Obłożenie: {{ round($stats['percent_of_rent']) }}%</div>
    <div>Średnia ilość dni na rezerwację: {{ $stats['average_length_of_reservation'] }}</div>
    @endif
</div>

<div class="container">
        <div class="row">
            <div class="col border text-center">Apartamenty</div>
            <div class="col alert-dark text-center border">Rezerwacje</div>
            <div class="col alert-dark text-center border">Suma dni</div>
            <div class="col alert-dark text-center border">Suma należności</div>
            <div class="col alert-dark text-center border">Teoretycznie dla 100%</div>
            <div class="col alert-dark text-center border">Efektywność</div>
        </div>
    @foreach ( $apartments as $apartment )
        <div class="row">
            <div class="col alert-dark text-right border">{{ $apartment['name'] }}</div>
            <div class="col text-center border">{{ $apartment['total_reservations'] }}</div>
            <div class="col text-center border">{{ $apartment['days_reserved'] }}</div>
            <div class="col text-center border">{{ $apartment['total_income'] }}</div>
            <div class="col text-center border">{{ $apartment['total_possible_income'] }}</div>
            <div class="col text-center border">{{ ($apartment['total_income']) ? round($apartment['total_income'] / $apartment['total_possible_income'] * 100) : 0 }}%</div>
        </div>
    @endforeach
        <div class="row">
            <div class="col alert-dark text-center border">SUMA</div>
        </div>
        <div class="row">
            <div class="col border text-center">{{ $stats['count_apartments'] }}</div>
            <div class="col text-center border">{{ $stats['overlapping']+$stats['internal'] }}</div>
            <div class="col text-center border">{{ $stats['count_reserved_days'] }}</div>
            <div class="col text-center border">{{ $stats['estimated_total_income'] }}</div>
            <div class="col text-center border">Teoretycznie dla 100%</div>
            <div class="col text-center border">{{ round($stats['percent_of_rent']) }}%</div>
        </div>
</div>

@endsection