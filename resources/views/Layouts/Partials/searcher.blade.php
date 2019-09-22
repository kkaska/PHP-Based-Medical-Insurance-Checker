<div class="absolute">
        <div class="row">
            <div class="col-sm-12 col-md-7 col-lg-5 my-auto mx-auto">
                <p>*the icon colour needs to be fixed (figure out how to add pic from storage)</p>
                <p>*the navbar doesn't work (google laravel breadcrumbs)</p>
                    <div class="card card-center my-5 bg-white" style="border: none; border-radius: 15px;">
                            <div class="card-body">
                                <!-- add correct colour icon -->
                                    <h1 class="card-title text-center font-weight-bold text-success" ><img src="https://img.icons8.com/ios-glyphs/50/000000/find-hospital.png" width="50" height="50" class="align-bottom" alt="HealthScanner Icon">HealthScanner</h1>
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