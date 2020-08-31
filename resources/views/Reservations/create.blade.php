@extends("layouts.app")

@section("content")
<h3>{{__('New reservation')}}</h3>

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

    <form method="POST" action="{{ route('reservations.store') }}">
        @csrf
        <div class="form-group">
            <label for="apartments_id">{{__('Aparment')}}:</label>
            <input name="apartments_id" value="{{ old('apartments_id') }}" type="number" required class="form-control" id="apartments_id">
        </div>
        <div class="form-group">
            <label for="clients_id">{{__('Client')}}:</label>
            <input name="clients_id" value="{{ old('clients_id') }}" type="number" required class="form-control" id="clients_id">
        </div>
        <div class="form-group">
            <label for="start_date">{{__('Date start')}}:</label>
            <input name="start_date" value="" type="text" required class="form-control" id="start_date">
        </div>
        <div class="form-group">
            <label for="end_date">{{__('Date end')}}:</label>
            <input name="end_date" value="" type="text" required class="form-control" id="end_date">
        </div>
        <div class="form-group">
            <label for="price_day">{{__('Price per day')}}:</label>
            <input name="price_day" value="{{ old('price_day') }}" type="number" required class="form-control" id="price_day">
        </div>
        <div class="form-group">
            <label for="money_paid">{{__('Money paid')}}:</label>
            <input name="money_paid" value="{{ old('money_paid') }}" type="number" required class="form-control" id="money_paid">
        </div>
        <div class="form-group">
            <label for="status">{{__('Status')}}:</label>
            <select name="status" value="{{ old('status') }}" type="number" required class="form-control" id="status">
                <option value="Not paid" selected>Not paid</option>
                <option value="Partially paid">Partially paid</option>
                <option value="Fully paid">Fully paid</option>
                <option value="Cancelled">Cancelled</option>
                <option value="Not available">Not available</option>
            </select>
        </div>
        <div class="form-group">
            <label for="adults">{{__('Adults')}}:</label>
            <input name="adults" value="{{ old('adults') }}" type="number" required class="form-control" id="adults">
        </div>
        <div class="form-group">
            <label for="kids">{{__('Kids')}}:</label>
            <input name="kids" value="{{ old('kids') }}" type="number" required class="form-control" id="kids">
        </div>
        <div class="form-group">
            <label for="notes">{{__('Notes')}}:</label>
            <textarea name="notes" class="form-control" id="notes" rows="3">{{ old('notes') }}</textarea>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary mb-2" value="{{__('save')}}" />
            <a href="{{ route('reservations.index') }}" class="btn btn-danger mb-2">{{__('cancel')}}</a>
        </div>
    </form>
</div>
@endsection