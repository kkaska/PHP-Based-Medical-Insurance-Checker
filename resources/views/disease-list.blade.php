@extends('layouts.app')

@section('content')
<div class="container-fluid mt-3">
    <div class="card-group">
        <div class="card col overflow:auto">
            <div class="card-body">
                <table class="table table-hover">
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
                            <td class="hospital-name">{{ $treatments[$i]->HospitalName }}</td>
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
                    var position = {lat: {{ $userLatitude }}, lng: {{ $userLongitude }}};   //Get Lat and Lng from laravel's session
                </script>
                <script src="{{ URL::asset('js/maps-list.js') }}"></script>
            </div>
        </div>
    </div>
</div>
@endsection