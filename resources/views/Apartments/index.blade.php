@extends("layouts.app")

@section("content")
<p>Apartments - <a href="{{ route('apartments.create') }}">add new</a></p>

<div>
    <ul>
        @foreach ( $apartments as $apartment )
        <li>
            <span class="btn bg-light">{{ $apartment['name'] }}</span>
            <a class="btn bg-primary" href="{{ route('apartments.edit', ['apartment' => $apartment['id']]) }}">edit</a>
            <a class="btn bg-danger" href="{{ route('apartments.destroy', ['apartment' => $apartment['id']]) }}">delete</a>
        </li>
        @endforeach
    </ul>
</div>
@endsection