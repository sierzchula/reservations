@extends("layouts.app")

@section("content")
<p>Clients - <a href="{{ route('clients.create') }}">add new</a></p>

<div class="d-flex flex-column">
   
    @foreach ( $clients as $client )
    <div class="p-1">
        <a class="btn bg-primary text-white" href="{{ route('clients.show', ['client' => $client['id']]) }}">{{ $client['name'] }}</a>
    </div>
    @endforeach
   
</div>
@endsection