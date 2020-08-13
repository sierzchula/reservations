@extends("layouts.app")

@section('content')
<p>{{ $apartment['name'] }} <a class="btn bg-primary text-white" href="{{ route('apartments.edit', ['apartment' => $apartment['id']]) }}">edit</a></p>
@endsection