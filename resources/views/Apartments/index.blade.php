@extends("layouts.app")

@section("content")
<p>Apartments - <a href="{{ route('apartments.create') }}">add new</a></p>

<div class="d-flex flex-column">
   
    @foreach ( $apartments as $apartment )
    <div class="p-1">
        <a class="btn bg-primary text-white" href="{{ route('apartments.edit', ['apartment' => $apartment['id']]) }}">{{ $apartment['name'] }}</a>
    </div>
    @endforeach
   
</div>
@endsection