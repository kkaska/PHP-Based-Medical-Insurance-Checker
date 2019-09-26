@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js" integrity="sha384-+GtXzQ3eTCAK6MNrGmy3TcOujpxp7MnMAi6nvlvbZlETUcZeCk7TDwvlCw9RiV6R" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js" integrity="sha384-HROCV4TFvq4sMXGTbCGk504wpRgZibLtjdZELybVsTEs8srtNMtg0RJOiNNisZgB" crossorigin="anonymous"></script>
<div class="absolute">
    <div class="side">
        <div class="row">
            <div class="col-sm-12 col-md-7 col-lg-5 my-auto mx-auto">
                <p>*the navbar doesn't work (google laravel breadcrumbs)</p>
                    <div class="card card-center my-5 bg-white" style="border: none; border-radius: 15px;">
                            <div class="card-body">
                            <h1 class="card-title text-center font-weight-bold text-success"><img src={{ asset('img/icon.png') }} width = 50px height = 50px alt="HealthScanner icon logo">HealthScanner</h1>
                                    <hr class="my-4" style="width: 80%;">
                                    {{ Form::open(array('url' => 'search', 'method' => 'post')) }}
                                        <div class="form-group">
                                                <input class="typeahead form-control" type="text" id="disease" name="disease" aria-label="Disease" placeholder="Procedure" autocomplete="off">
                                                <label style="display: none" for="disease">procedure</label>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-lg" id="city" name="city" aria-label="City" placeholder="City" required>
                                                <label style="display: none" for="city">city</label>
                                                <div class="input-group-append">
                                                    <!--add accessibility to button-->
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
</div>
    <script src="{{ URL::asset("js/map-test.js") }}"></script>
    <!-- Script to autocomplete form @author Finn  --->
    <script type="text/javascript">
        var route = "{{ url('autocomplete') }}";
        $('#disease').typeahead({
            minLength: 4,
            source:  function (term, process) {
                return $.get(route, { term: term }, function (data) {
                    console.log(term + " --- " + data);
                    return process(data);
                });
            }
        });
    </script>
@endsection

