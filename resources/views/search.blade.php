@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Form::open(array('url' => 'search', 'method' => 'post')) }}
            <legend class="text-center">Search for disease</legend>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Disease</span>
                    </div>
                    <input type="text" class="form-control form-control-lg" aria-label="Disease">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">City</span>
                    </div>
                    <input type="text" class="form-control form-control-lg" aria-label="City">
                </div>
            </div>
            {{ Form::submit('Submit', array('class' => 'form-control btn btn-success')) }}
        {{ Form::close() }}
    </div>
@endsection