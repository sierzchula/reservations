@extends("layouts.app")

@section("content")
<p>Klienci - <a href="{{ route('clients.create') }}">dodaj</a></p>

<label name="search_clients" for="search_clients">Szukaj:</label>
<input type="text" id="search_clients" placeholder="dane klienta" />

<div id="clients_container">
   
    @foreach ( $clients as $client )
    <div class="p-1 clients_sub_container">
        <a class="btn bg-primary text-white" href="{{ route('clients.show', ['client' => $client['id']]) }}">{{ $client['name'] }} ( telefon: {{ $client['phone'] }} / adres: {{ $client['address'] }} / email: {{ $client['email'] }} )</a>
    </div>
    @endforeach
   
</div>
@endsection