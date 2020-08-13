@extends("layouts.app")

@section("content")
<h3>{{__('Edit apartment')}}</h3>

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

    <form method="POST" action="{{ route( 'apartments.update', ['apartment' => $apartment['id']] ) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">{{__('Name')}}:</label>
            <input name="name" value="{{ $apartment['name'] }}" type="text" required max="255" class="form-control" id="name" placeholder="{{__('Name your apartment')}}">
        </div>
        <div class="form-group">
            <label for="address">{{__('Address')}}:</label>
            <input name="address" value="{{ $apartment['address'] }}" type="text" required max="255" class="form-control" id="address" placeholder="{{__('full address')}}">
        </div>
        <div class="form-group">
            <label for="persons">{{__('Persons max')}}:</label>
            <input name="persons" value="{{ $apartment['persons'] }}" type="number" required min="1" max="16" class="form-control" id="persons" placeholder="{{__('How many people can live there?')}}">
        </div>
        <div class="form-group">
            <label for="notes">{{__('Notes')}}:</label>
            <textarea name="notes" class="form-control" id="notes" rows="3">{{ $apartment['notes'] }}</textarea>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary mb-2" value="{{__('save')}}" />
            <a href="{{ route('apartments.show', ['apartment' => $apartment['id']]) }}" class="btn btn-danger mb-2">{{__('cancel')}}</a>
        </div>
    </form>
    <form method="POST" action="{{ route('apartments.destroy', ['apartment' => $apartment['id']]) }}">
        @csrf
        @method('DELETE')
        <div class="d-flex">
            <input type="submit" class="ml-auto btn bg-warning mb-2" value="{{__('delete')}}" />
        </div>
    </form>
</div>
@endsection