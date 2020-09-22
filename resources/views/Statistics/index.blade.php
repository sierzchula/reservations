@extends("layouts.app")

@section("content")

<form method="POST" action="{{ route('statistics.index') }}" autocomplete="off">
        @csrf
    <div class="d-flex flex-row">
        <div class="form-group">
            <label for="start_date">{{__('Początek')}}:</label>
            <div id="start_date_show" date="{{ date('m/d/Y', $start_date) }}"></div>
            <input name="start_date" value="{{ date('m/d/Y', $start_date) }}" type="hidden" required class="form-control" id="start_date">
        </div>
        <div class="form-group">
            <label for="end_date">{{__('Koniec')}}:</label>
            <div id="end_date_show" date="{{ date('m/d/Y', $end_date) }}"></div>
            <input name="end_date" value="{{ date('m/d/Y', $end_date) }}" type="hidden" required class="form-control" id="end_date">
        </div>
    </div>
    
    <div class="form-group">
        <input type="submit" class="btn btn-primary mb-2" value="{{__('szukaj')}}" />
    </div>
</form>

@endsection