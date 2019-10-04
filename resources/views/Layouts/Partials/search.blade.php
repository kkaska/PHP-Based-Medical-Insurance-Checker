<div class="container-fluid mt-3">
    <div class="row justify-content-center">
        <div class="col-xl-12">
            <div class="card border-success bg-light">
                <div class="card-body text-center">
                    <h1 class="card-title text-center font-weight-bold text-darkgray"><img src={{ asset('img/icon.png') }} width = 50px height = 50px alt="HealthScanner icon logo">HealthScanner</h1>
                    <hr class="my-4 w-50">
                    {{ Form::open(array('url' => 'search', 'method' => 'post', 'id' => 'searchForm')) }}
                    <div class="form-row justify-content-center pl-2 pr-2">
                        <div class="col-xl-6">
                            <div class="form-group">
                                <input class="typeahead form-control form-control-lg" type="text"  id="disease" name="disease" aria-label="Disease" placeholder="Procedure" required autocomplete="off">
                                <label style="display: none" for="disease">procedure</label>
                            </div>
                        </div>
                        <div class="col-xl-2">
                            <div class="form-group">
                                <select class="typeahead form-control form-control-lg" id="radius" name="radius" required>
                                    <option value="" disabled selected>Radius (miles)</option>
                                    <option value="10">10 miles</option>
                                    <option value="25">25 miles</option>
                                    <option value="50">50 miles</option>
                                    <option value="100">100 miles</option>
                                    <option value="1000">1000 miles</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-lg" id="city" name="city" aria-label="City" placeholder="City" required>
                                    <label style="display: none" for="city">Address</label>
                                    <div class="input-group-append">
                                        <button id="Click to find location" class="btn btn-success text-darkgray font-weight-bold" type="button">Find</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="user-latitude" name="user-latitude">
                    <input type="hidden" id="user-longitude" name="user-longitude">
                    <input type="button" id="search-button" class="btn btn-success btn-lg text-uppercase font-weight-bold text-darkgray" value="Search">
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ URL::asset("js/map-search.js") }}"></script>
<!-- Script to autocomplete form @author Finn  --->
<script type="text/javascript">
    $(document).ready(function() {
        $( "#disease" ).autocomplete({
                                             
            source: function(request, response) {
             $.ajax({
             url: "{{url('autocomplete')}}",
            data: {
                term : request.term
            },
            dataType: "json",
            success: function(data){
                var resp = $.map(data,function(obj){
                    return obj.Name;
            }); 
                                             
                response(resp);
            }
            });
            },
        minLength: 2
        });

        $('#search-button').click(function () {
            let geocoder = new google.maps.Geocoder;
            geocoder.geocode({'address' : $("#city").val()}, function (results, status) {
                if (status === 'OK') {
                    let location = results[0].geometry.location;
                    $('#user-latitude').val(location.lat());
                    $('#user-longitude').val(location.lng());

                    $('#searchForm').submit();
                }
            });
        })

        //Autofill the search form
        let searchParams = new URLSearchParams(window.location.search);
        if (searchParams.has('disease')) {
            $("#disease").val(searchParams.get('disease'));
        }
        if (searchParams.has('city')) {
            $("#city").val(searchParams.get('city'));
        }
    });
 </script>
