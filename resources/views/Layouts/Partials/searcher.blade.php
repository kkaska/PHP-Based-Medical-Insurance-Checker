@extends('layouts.app')

@section('content')
    <div class="container-fluid mt-3">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h1 class="card-title text-center font-weight-bold text-success"><img src={{ asset('img/icon.png') }} width = 50px height = 50px alt="HealthScanner icon logo">HealthScanner</h1>
                        <hr class="my-4">
                        {{ Form::open(array('url' => 'search', 'method' => 'post')) }}
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="disease" name="disease" aria-label="Disease" placeholder="Procedure" required autofocus>
                            <label style="display: none" for="disease">procedure</label>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control form-control-lg" id="city" name="city" aria-label="City" placeholder="City" required>
                                <label style="display: none" for="city">city</label>
                                <div class="input-group-append">
                                    <!--add location functionality-->
                                    <button id="location" class="btn btn-success" type="button">Use your location</button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" id="user-latitude" name="user-latitude">
                        <input type="hidden" id="user-longitude" name="user-longitude">
                        {{ Form::submit('Search', array('class' => 'form-control btn btn-success btn-large btn-block text-uppercase font-weight-bold')) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ URL::asset("js/map-test.js") }}"></script>

@endsection
