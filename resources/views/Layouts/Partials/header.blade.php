<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <nav class="navbar justify-content-start">
                    <h1 class="navbar-brand mb-0 h1 text-success font-weight-bold"><img src={{ asset('img/icon.png') }} width = 25px height = 25px alt="HealthScanner icon logo" class="align-top">HealthScanner</h1>

                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ URL::to('/') }}/home">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::to('/') }}/search">Search</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ URL::to('/') }}/hospitals">Hospitals</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>