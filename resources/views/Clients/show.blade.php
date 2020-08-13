@extends("layouts.app")

@section('content')
<p>{{ $client['name'] }} <a class="btn bg-primary text-white" href="{{ route('clients.edit', ['client' => $client['id']]) }}">{{__('edit')}}</a></p>
<div>
    <div>{{ $client['address'] }}</div>
    <div>{{ $client['email'] }}</div>
    <div>{{ $client['phone'] }}</div>
    <div class="pt-4">{{ $client['notes'] }}</div>
</div>
@endsection