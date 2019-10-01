@extends('layouts.app')

@section('content')
@include('layouts.partials.search')

<div class="container-fluid mt-3">
    <div class="card-group">
        <div class="card col-sm-12 col-md-12 col-lg-12 col-xl-12 overflow:auto border-success bg-light" style="min-height: 500px; min-width:320px;">
            <div class="card-body table-responsive">
                <p class="lead text-center" style="font-size: 20px;" >You are searching for <strong>{{ $disease }}</strong> in <strong>{{ $city }}</strong> within <strong>{{ $radius }}</strong> miles.</p>
                <table class="table table-hover table-sm">
                    <tr>
                        <th scope="col" class="align-middle">Hospital</th>
                        <th scope="col" class="align-middle">City</th>
                        <th scope="col" class="align-middle"><a href="{{ url()->full() }}&cost= {{request()->get('cost') == 'ASC' ? 'DESC' : 'ASC' }}">Cost</a></th>
                        <th scope="col" class="align-middle">Distance</th>
                        <th scope="col" class="align-middle">View Data</th>
                    </tr>
                    <tbody>
                        @for($i = 0; $i < count($treatments); $i++)
                        <tr class="hospital-data" scope="row" data-hospital-address="{{ $treatments[$i]->HospitalAddress }}" data-hospital-postCode="{{ $treatments[$i]->HospitalPostCode }}">
                            <td class="hospital-name">{{ $treatments[$i]->HospitalName }}</td>
                            <td class="hospital-city text-capitalize">{{ $treatments[$i]->City }}</td>
                            <td>@parseMoney($treatments[$i]->AverageCharges)</td>
                            <td class="distance"></td>
                            <td>
                                <a href='treatment?disease={{urlencode($treatments[$i]->DiseaseID)}}&hospital={{urlencode($treatments[$i]->HospitalID)}}'>View</a>
                            </td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
                <div class="flexBox" style="display: flex; flex-flow: row wrap; justify-content: center;">
                    {!! $treatments->appends(\Request::except('page'))->render() !!}
                </div>
            </div>
        </div>
        <div class="card col-sm-12 col-md-12 col-lg-12 col-xl-6 border-success bg-light" style="min-height: 500px; min-width: 320px;">
            <div class="card-body">
                <!-- Google Maps -->
                <div id="map"></div>
                <script>
                    var position = {lat: {{ json_encode($userLatitude) }}, lng: {{ json_encode($userLongitude) }}};   //Get Lat and Lng from laravel's session
                </script>
                <script src="{{ URL::asset('js/maps-list.js') }}"></script>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        //Autocomplete the search form
        let searchParams = new URLSearchParams(window.location.search);

        if (searchParams.has('radius')) {
            $('#radius option[value=' + searchParams.get('radius') + ']').prop('selected', true);
        }
    });
</script>
@endsection

