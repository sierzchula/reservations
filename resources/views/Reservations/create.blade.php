@extends("layouts.app")

@section("content")
<h3>{{__('Nowa rezerwacja')}}</h3>

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

    <form method="POST" action="{{ route('reservations.store') }}" autocomplete="off">
        @csrf
        <div class="form-group">
            <label for="apartments_id">{{__('Apartament')}}:</label>
            <select name="apartments_id" required class="form-control" id="apartments_id">
                @foreach( $apartments as $apartment_foreach )
                    <option value="{{ $apartment_foreach['id'] }}" @if($apartment['id'] == $apartment_foreach['id']) selected @endif >{{ $apartment_foreach['name'] }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="clients_id">{{__('Klient')}}:</label>
            <select name="clients_id" required class="form-control" id="clients_id">
                @foreach( $clients as $client )
                    <option value="{{ $client['id'] }}">{{ $client['name'] }} ( {{ $client['phone'] }} )</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="start_date">{{__('Dzień przyjazdu')}}:</label>
            <div id="start_date_show"></div>
            <input name="start_date" value="" type="hidden" required class="form-control" id="start_date">
        </div>
        <div class="form-group">
            <label for="end_date">{{__('Dzień wyjazdu')}}:</label>
            <div id="end_date_show"></div>
            <input name="end_date" value="" type="hidden" required class="form-control" id="end_date">
        </div>
        <div class="form-group">
            <label for="price_day">{{__('Cena za dobę')}}:</label>
            <input name="price_day" value="{{ old('price_day') }}" type="number" step="any" required class="form-control" id="price_day">
        </div>
        <div class="form-group">
            <label for="money_total">{{__('Koszt całego pobytu')}}:</label>
            <input name="money_total" value="{{ old('money_total') }}" type="number" step="any" required class="form-control" id="money_total">
        </div>
        <div class="form-group">
            <label for="money_paid">{{__('wpłacona zaliczka')}}:</label>
            <input name="money_paid" value="{{ old('money_paid') }}" type="number" step="any" required class="form-control" id="money_paid">
        </div>
        <div class="form-group">
            <label for="status">{{__('Status')}}:</label>
            <select name="status" value="{{ old('status') }}" type="number" required class="form-control" id="status">
                <option value="Not paid" selected>Brak wpłaty</option>
                <option value="Partially paid">Wpłacona zaliczka</option>
                <option value="Fully paid">Zapłacono</option>
                <option value="Cancelled">Płatność Booking</option>
                <option value="Not available">Niedostępny</option>
            </select>
        </div>
        <div class="form-group">
            <label for="adults">{{__('Dorośli')}}:</label>
            <input name="adults" value="{{ old('adults') }}" type="number" required class="form-control" id="adults">
        </div>
        <div class="form-group">
            <label for="kids">{{__('Dzieci')}}:</label>
            <input name="kids" value="{{ old('kids') }}" type="number" required class="form-control" id="kids">
        </div>
        <div class="form-group">
            <label for="notes">{{__('Uwagi')}}:</label>
            <textarea name="notes" class="form-control" id="notes" rows="3">{{ old('notes') }}</textarea>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary mb-2" value="{{__('zapisz')}}" />
            <a href="{{ route('reservations.index') }}" class="btn btn-danger mb-2">{{__('anuluj')}}</a>
        </div>
    </form>
</div>

<script>
{{-- update datepicker with disabled dates --}}
</script>

@endsection