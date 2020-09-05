@extends("layouts.app")

@section("content")
<h3>{{__('Dodaj klienta')}}</h3>

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

    <form method="POST" action="{{ route('clients.store') }}">
        @csrf
        <div class="form-group">
            <label for="name">{{__('Imię i nazwisko')}}:</label>
            <input name="name" value="{{ old('name') }}" type="text" required max="255" class="form-control" id="name">
        </div>
        <div class="form-group">
            <label for="phone">{{__('Telefon')}}:</label>
            <input name="phone" value="{{ old('phone') }}" type="text" required min="5" max="16" class="form-control" id="phone">
        </div>
        <div class="form-group">
            <label for="address">{{__('Adres')}}:</label>
            <input name="address" value="{{ old('address') }}" type="text" required max="255" class="form-control" id="address">
        </div>
        <div class="form-group">
            <label for="email">{{__('E-mail')}}:</label>
            <input name="email" value="{{ old('email') }}" type="email" required max="255" class="form-control" id="email">
        </div>
        <div class="form-group">
            <label for="notes">{{__('Uwagi')}}:</label>
            <textarea name="notes" class="form-control" id="notes" rows="3">{{ old('notes') }}</textarea>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary mb-2" value="{{__('zapisz')}}" />
            <a href="{{ route('clients.index') }}" class="btn btn-danger mb-2">{{__('anuluj')}}</a>
        </div>
    </form>
</div>
@endsection