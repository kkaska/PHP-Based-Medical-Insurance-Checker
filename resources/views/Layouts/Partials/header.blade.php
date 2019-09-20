<nav class="navbar navbar-expand-lg navbar-dark bg-danger">
    <a href="{{ URL::to('/') }}/home" class="navbar-brand">Craneware: Medical Procedure Locator</a>

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="{{ URL::to('/') }}/search">Search</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ URL::to('/') }}/hospitals">Hospitals</a>
            </li>
    </div>
</nav>