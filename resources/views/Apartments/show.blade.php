@extends("layouts.app")

@section('content')
<p>{{ $apartment['name'] }} <a class="btn bg-primary text-white" href="{{ route('apartments.edit', ['apartment' => $apartment['id']]) }}">{{__('edytuj')}}</a></p>
<div>
    <div>{{ $apartment['address'] }}</div>
    <div class="pt-4">{{__('Limit osób')}}: {{ $apartment['persons'] }}</div>
    <div class="pt-4">{{__('Uwagi')}}: {{ $apartment['notes'] }}</div>
</div>
@endsection