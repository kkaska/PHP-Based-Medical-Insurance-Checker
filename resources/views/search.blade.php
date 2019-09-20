@extends('layouts.app')

@section('content')
    <div class="container">
        <form>
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
            <input type="submit" class="form-control btn btn-success">
        </form>
    </div>
@endsection