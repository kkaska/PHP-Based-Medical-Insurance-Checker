<div class="absolute">
    <div class="side">
        <div class="row">
            <div class="col-sm-12 col-md-7 col-lg-5 my-auto mx-auto">
                <p>*the navbar doesn't work (google laravel breadcrumbs)</p>
                    <div class="card card-center my-5 bg-white" style="border: none; border-radius: 15px;">
                            <div class="card-body">
                            <h1 class="card-title text-center font-weight-bold text-success"><img src={{ asset('img/icon.png') }} width = 50px height = 50px alt="HealthScanner icon logo">HealthScanner</h1>
                                    <hr class="my-4" style="width: 80%;">
                                    {{ Form::open(array('url' => 'search/list', 'method' => 'get')) }}
                                        <div class="form-group">
                                                <input type="text" class="form-control form-control-lg" id="disease" name="disease" aria-label="Disease" placeholder="Procedure" required autofocus>
                                                <label style="display: none" for="disease">procedure</label>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input type="text" class="form-control form-control-lg" id="city" name="city" aria-label="City" placeholder="City" required>
                                                <label style="display: none" for="city">city</label>
                                                <div class="input-group-append">
                                                    <!--add accessibility to button-->
                                                        <button class="btn btn-success" type="button">Use your location</button>
                                                </div>
                                            </div>
                                        </div>
                                        {{ Form::submit('Search', array('class' => 'form-control btn btn-success btn-large btn-block text-uppercase font-weight-bold')) }}
                                    {{ Form::close() }}
                            </div>
                    </div>
            </div> 
    </div>
    </div>
</div>
