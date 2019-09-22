@extends('layouts.app')

@section('content')
@include ('layouts.partials.breadcrumbs')

    <div class="container">
        {{ Form::open(array('url' => 'search/list', 'method' => 'get')) }}
            <legend class="text-center">Search for disease</legend>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Disease</span>
                    </div>
                    <input type="text" class="form-control form-control-lg" id="disease" name="disease" aria-label="Disease" required>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">City</span>
                    </div>
                    <input type="text" class="form-control form-control-lg" id="city" name="city" aria-label="City">
                </div>
            </div>
            {{ Form::submit('Search', array('class' => 'form-control btn btn-success')) }}
        {{ Form::close() }}
    </div>
@endsection