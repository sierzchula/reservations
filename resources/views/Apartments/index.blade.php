@extends("layouts.app")

@section("content")
<p>Apartamenty - <a href="{{ route('apartments.create') }}">dodaj</a></p>

<div class="d-flex flex-column">
   
    @foreach ( $apartments as $apartment )
    <div class="p-1">
        <a class="btn bg-primary text-white" href="{{ route('apartments.show', ['apartment' => $apartment['id']]) }}">{{ $apartment['name'] }}</a>
    </div>
    @endforeach
   
</div>
@endsection