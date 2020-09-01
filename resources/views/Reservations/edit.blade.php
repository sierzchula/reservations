@extends("layouts.app")

@section("content")
<h3>{{__('Edit reservation')}}</h3>

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
            <label for="apartments_id">{{__('Aparment')}}:</label>
            <input name="apartments_id" value="{{ $reservation['apartments_id'] }}" type="number" required class="form-control" id="apartments_id">
        </div>
        <div class="form-group">
            <label for="clients_id">{{__('Client')}}:</label>
            <input name="clients_id" value="{{ $reservation['clients_id'] }}" type="number" required class="form-control" id="clients_id">
        </div>
        <div class="form-group">
            <label for="start_date">{{__('Date start')}}:</label>
            <div id="start_date_show"></div>
            <input name="start_date" value="{{ date('m/d/yy', $reservation['start_date']) }}" type="hidden" required class="form-control" id="start_date">
        </div>
        <div class="form-group">
            <label for="end_date">{{__('Date end')}}:</label>
            <div id="end_date_show"></div>
            <input name="end_date" value="{{ date('m/d/yy', $reservation['end_date']) }}" type="hidden" required class="form-control" id="end_date">
        </div>
        <div class="form-group">
            <label for="price_day">{{__('Price per day')}}:</label>
            <input name="price_day" value="{{$reservation['price_day'] }}" type="number" required class="form-control" id="price_day">
        </div>
        <div class="form-group">
            <label for="money_paid">{{__('Money paid')}}: ({{__('Total before changes')}}: {{$reservation['money_total']}})</label>
            <input name="money_paid" value="{{ $reservation['money_paid'] }}" type="number" required class="form-control" id="money_paid">
        </div>
        <div class="form-group">
            <label for="status">{{__('Status')}}:</label>
            <select name="status" type="number" required class="form-control" id="status">
                <option value="Not paid" @if ( $reservation['status'] == 'Not paid' ) selected @endif>Not paid</option>
                <option value="Partially paid"@if ( $reservation['status'] == 'Partially paid' ) selected @endif>Partially paid</option>
                <option value="Fully paid"@if ( $reservation['status'] == 'Fully paid' ) selected @endif>Fully paid</option>
                <option value="Cancelled"@if ( $reservation['status'] == 'Cancelled' ) selected @endif>Cancelled</option>
                <option value="Not available"@if ( $reservation['status'] == 'Not available' ) selected @endif>Not available</option>
            </select>
        </div>
        <div class="form-group">
            <label for="adults">{{__('Adults')}}:</label>
            <input name="adults" value="{{$reservation['adults'] }}" type="number" required class="form-control" id="adults">
        </div>
        <div class="form-group">
            <label for="kids">{{__('Kids')}}:</label>
            <input name="kids" value="{{ $reservation['kids'] }}" type="number" required class="form-control" id="kids">
        </div>
        <div class="form-group">
            <label for="notes">{{__('Notes')}}:</label>
            <textarea name="notes" class="form-control" id="notes" rows="3">{{ $reservation['notes'] }}</textarea>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary mb-2" value="{{__('save')}}" />
            <a href="{{ route('reservations.index') }}" class="btn btn-danger mb-2">{{__('cancel')}}</a>
        </div>
    </form>
</div>
@endsection