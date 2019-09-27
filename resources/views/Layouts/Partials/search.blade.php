<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js" integrity="sha384-+GtXzQ3eTCAK6MNrGmy3TcOujpxp7MnMAi6nvlvbZlETUcZeCk7TDwvlCw9RiV6R" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js" integrity="sha384-HROCV4TFvq4sMXGTbCGk504wpRgZibLtjdZELybVsTEs8srtNMtg0RJOiNNisZgB" crossorigin="anonymous"></script>
<div class="container-fluid mt-3">
    <div class="row justify-content-center">
        <div class="col-xl-12">
            <div class="card border-success bg-light">
                <div class="card-body text-center">
                    <h1 class="card-title text-center font-weight-bold text-success"><img src={{ asset('img/icon.png') }} width = 50px height = 50px alt="HealthScanner icon logo">HealthScanner</h1>
                    <hr class="my-4 w-50">
                    {{ Form::open(array('url' => 'search/list', 'method' => 'get')) }}
                    <div class="form-row justify-content-center">
                        <div class="col-xl-3">
                            <div class="form-group">
                                <input class="typeahead form-control form-control-lg" type="text"  id="disease" name="disease" aria-label="Disease" placeholder="Procedure" required autofocus autocomplete="off">
                                <label style="display: none" for="disease">procedure</label>
                            </div>
                        </div>
                        <div class="col-xl-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" id="city" name="city" aria-label="City" placeholder="City" required>
                                    <label style="display: none" for="city">city</label>
                                    <div class="input-group-append">
                                        <button class="btn btn-success" type="button">Find</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ Form::submit('Search', array('class' => 'btn btn-success btn-lg text-uppercase font-weight-bold')) }}
                    {{ Form::close() }}
                    
                </div>
            </div>
        </div>
    </div>
</div>

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
