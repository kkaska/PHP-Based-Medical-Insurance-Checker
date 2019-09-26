@extends('layouts.app')

@section('content')
<div class="container-fluid mt-3">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js" integrity="sha384-+GtXzQ3eTCAK6MNrGmy3TcOujpxp7MnMAi6nvlvbZlETUcZeCk7TDwvlCw9RiV6R" crossorigin="anonymous"></script>
    <div class="card-group">
        <div class="card col overflow:auto">
            <div class="card-body">
                <table class="table table-hover table-sm">
                    <tr>

                        <th scope="col" class="align-middle">Treatment</th>
                        <th scope="col" class="align-middle">Hospital</th>
                        <th scope="col" class="align-middle">City</th>
                        <th scope="col" class="align-middle">@sortablelink('AverageCharges', 'Cost')</th>
                        <th scope="col" class="align-middle">Distance</th>
                    </tr>
                    <tbody>

                    @for($i = 0; $i < count($treatments); $i++)
                        <tr scope="row">
                            <td>{{ $treatments[$i]->DiseaseName }}</td>
                            <td>{{ $treatments[$i]->HospitalName }}</td>
                            <td>{{ $treatments[$i]->City }}</td>
                            <td>@parseMoney($treatments[$i]->AverageCharges)</td>
                            <td></td>
                        </tr>
                    @endfor

                    </tbody>
                </table>

                {!! $treatments->appends(\Request::except('page'))->render() !!}
            </div>
        </div>
        <div class="card col-lg-5">
            <div class="card-body">
                <!-- Google Maps -->
                <div id="map"></div>
                <script>
                    function initMap() {
                        let position = {lat: {{ $userLatitude }}, lng: {{ $userLongitude }}};   //Get Lat and Lng from laravel's session

                        let map = new google.maps.Map(document.getElementById('map'), {
                            center: position,
                            zoom: 8
                        });

                        let marker = new google.maps.Marker({
                            position: position,
                            map: map
                        })


                    }
                </script>
                <script src="{{ URL::asset('js/maps-list.js') }}"></script>
                <!-- /Google Maps -->
            </div>
        </div>
    </div>
</div>
@endsection