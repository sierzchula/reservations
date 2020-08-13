@extends("layouts.app")

@section('content')
<p>{{ $client['name'] }} <a class="btn bg-primary text-white" href="{{ route('clients.edit', ['client' => $client['id']]) }}">edit</a></p>
@endsection