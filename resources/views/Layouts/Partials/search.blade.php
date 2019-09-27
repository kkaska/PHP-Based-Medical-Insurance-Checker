<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel = "stylesheet">
<script src = "https://code.jquery.com/jquery-1.10.2.js"></script>
<script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
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
                    console.log(request.term, obj.Name);
                    return obj.Name;
            }); 
                                             
                response(resp);
            }
            });
            },
        minLength: 4
        });
     });
 </script>
