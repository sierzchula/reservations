@extends("layouts.app")

@section("content")
<h3>{{__('Edit client')}}</h3>

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

    <form method="POST" action="{{ route( 'clients.update', ['client' => $client['id']] ) }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">{{__('Name')}}:</label>
            <input name="name" value="{{ $client['name'] }}" type="text" required max="255" class="form-control" id="name" placeholder="{{__('Client full name')}}">
        </div>
        <div class="form-group">
            <label for="phone">{{__('Phone')}}:</label>
            <input name="phone" value="{{ $client['phone'] }}" type="text" required min="5" max="16" class="form-control" id="phone" placeholder="{{__('Phone number')}}">
        </div>
        <div class="form-group">
            <label for="address">{{__('Address')}}:</label>
            <input name="address" value="{{ $client['address'] }}" type="text" required max="255" class="form-control" id="address" placeholder="{{__('full address')}}">
        </div>
        <div class="form-group">
            <label for="email">{{__('E-mail')}}:</label>
            <input name="email" value="{{ $client['email'] }}" type="email" required max="255" class="form-control" id="email" placeholder="{{__('e-mail')}}">
        </div>
        <div class="form-group">
            <label for="notes">{{__('Notes')}}:</label>
            <textarea name="notes" class="form-control" id="notes" rows="3">{{ $client['notes'] }}</textarea>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary mb-2" value="{{__('save')}}" />
            <a href="{{ route('clients.show', ['client' => $client['id']]) }}" class="btn btn-danger mb-2">{{__('cancel')}}</a>
        </div>
    </form>
    <form method="POST" action="{{ route('clients.destroy', ['client' => $client['id']]) }}">
        @csrf
        @method('DELETE')
        <div class="d-flex">
            <input type="submit" class="ml-auto btn bg-warning mb-2" value="{{__('delete')}}" />
        </div>
    </form>
</div>
@endsection

