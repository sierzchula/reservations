@extends("layouts.app")

@section('content')
<p>{{ $apartment['name'] }} <a class="btn bg-primary text-white" href="{{ route('apartments.edit', ['apartment' => $apartment['id']]) }}">{{__('edit')}}</a></p>
<div>
    <div>{{ $apartment['address'] }}</div>
    <div class="pt-4">{{__('Place for')}} {{ $apartment['persons'] }} {{__('persons')}}</div>
    <div class="pt-4">{{__('Notes')}}: {{ $apartment['notes'] }}</div>
</div>
@endsection