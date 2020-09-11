@extends("layouts.app")

@section("content")
<h3>{{__('Edycja rezerwacji')}}</h3>

<div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <form method="POST" action="{{ route('reservations.update', $reservation['id']) }}" autocomplete="off">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="apartments_id">{{__('Apartament')}}:</label>
            <select name="apartments_id" required class="form-control" id="apartments_id">
                @foreach( $apartments as $apartment_foreach )
                    <option value="{{ $apartment_foreach['id'] }}" @if($reservation['apartments_id'] == $apartment_foreach['id']) selected @endif >{{ $apartment_foreach['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="clients_id">{{__('Klient')}}: (<a href="{{ route('clients.show', ['client' => $reservation['clients_id']]) }}" >pokaż klienta</a>)</label>
            <select name="clients_id" required class="form-control" id="clients_id">
                @foreach( $clients as $client )
                    <option value="{{ $client['id'] }}" @if($reservation['clients_id'] == $client['id']) selected @endif >{{ $client['name'] }} ( {{ $client['phone'] }} )</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="start_date">{{__('Dzień przyjazdu')}}:</label>
            <div id="start_date_show" date="{{ date('m/d/Y', $reservation['start_date']) }}"></div>
            <input name="start_date" value="{{ date('m/d/Y', $reservation['start_date']) }}" type="hidden" required class="form-control" id="start_date">
        </div>
        <div class="form-group">
            <label for="end_date">{{__('Dzień wyjazdu')}}:</label>
            <div id="end_date_show" date="{{ date('m/d/Y', $reservation['end_date']) }}"></div>
            <input name="end_date" value="{{ date('m/d/Y', $reservation['end_date']) }}" type="hidden" required class="form-control" id="end_date">
        </div>
        <div class="form-group">
            <label for="price_day">{{__('Cena za dobę')}}:</label>
            <input name="price_day" value="{{$reservation['price_day'] }}" type="number" step="any" required class="form-control" id="price_day">
        </div>
        <div class="form-group">
            <label for="money_total">{{__('Koszt całego pobytu')}}:</label>
            <input name="money_total" value="{{ $reservation['money_total'] }}" type="number" step="any" required class="form-control" id="money_total">
        </div>
        <div class="form-group">
            <label for="money_paid">{{__('wpłacona zaliczka')}}:</label>
            <input name="money_paid" value="{{ $reservation['money_paid'] }}" type="number" step="any" required class="form-control" id="money_paid">
        </div>
        <div class="form-group">
            <label for="status">{{__('Status')}}:</label>
            <select name="status" type="number" required class="form-control" id="status">
                <option value="Not paid" @if ( $reservation['status'] == 'Not paid' ) selected @endif>Brak wpłaty</option>
                <option value="Partially paid"@if ( $reservation['status'] == 'Partially paid' ) selected @endif>Wpłacona zaliczka</option>
                <option value="Fully paid"@if ( $reservation['status'] == 'Fully paid' ) selected @endif>Zapłacono</option>
                <option value="Cancelled"@if ( $reservation['status'] == 'Cancelled' ) selected @endif>Anulowano</option>
                <option value="Not available"@if ( $reservation['status'] == 'Not available' ) selected @endif>Niedostępny</option>
            </select>
        </div>
        <div class="form-group">
            <label for="adults">{{__('Dorośli')}}:</label>
            <input name="adults" value="{{$reservation['adults'] }}" type="number" required class="form-control" id="adults">
        </div>
        <div class="form-group">
            <label for="kids">{{__('Dzieci')}}:</label>
            <input name="kids" value="{{ $reservation['kids'] }}" type="number" required class="form-control" id="kids">
        </div>
        <div class="form-group">
            <label for="notes">{{__('Uwagi')}}:</label>
            <textarea name="notes" class="form-control" id="notes" rows="3">{{ $reservation['notes'] }}</textarea>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary mb-2" value="{{__('zapisz')}}" />
            <a href="{{ route('reservations.index') }}" class="btn btn-danger mb-2">{{__('anuluj')}}</a>
        </div>
    </form>

    <form method="POST" action="{{ route('reservations.destroy', ['reservation' => $reservation['id']]) }}">
        @csrf
        @method('DELETE')
        <div class="d-flex">
            <input type="submit" class="ml-auto btn bg-warning mb-2" value="{{__('usuń')}}" />
        </div>
    </form>
</div>
@endsection