@extends('layouts.app')
@section('pageTitle', 'Search Result')
@section('content')
@include('layouts.partials.search')

<div class="container-fluid mt-3">
    <div class="card-group">
        <div class="card col-sm-12 col-md-12 col-lg-12 col-xl-12 overflow:auto border-success bg-light" style="height:600px; min-height: 500px; min-width:320px;">
            <div class="card-body table-responsive">
                <p class="text-lowercase lead text-center" style="font-size: 20x;" >You are searching for <strong>{{ $disease }}</strong> in <strong>{{ $city }}</strong>.</p>
                <table class="table table-hover">
                    <caption style="display: none;">A table displaying a list of hospitals that provide the searched procedure.</caption>
                    <tr>
                        {{-- <th scope="col" class="align-middle">Treatment</th> --}}
                        <th scope="col" class="align-middle">Hospital</th>
                        {{-- <th scope="col" class="align-middle">City</th> --}}
                        <th scope="col" class="align-middle">@sortablelink('AverageCharges', 'Cost')</th>
                        <th scope="col" class="align-middle">Distance</th>
                        <th scope="col" class="align-middle">View Data</th>
                    </tr>
                    <tbody>
                        @for($i = 0; $i < count($treatments); $i++)
                        <tr class="hospital-data text-lowercase" scope="row" data-hospital-address="{{ $treatments[$i]->HospitalAddress }}" data-hospital-postCode="{{ $treatments[$i]->HospitalPostCode }}">
                            {{-- <td>{{ $treatments[$i]->DiseaseName }}</td> --}}
                            <td class="hospital-name text-lowercase">{{ $treatments[$i]->HospitalName }}</td>
                            {{-- <td class="hospital-city text-lowercase">{{ $treatments[$i]->City }}</td> --}}
                            <td>@parseMoney($treatments[$i]->AverageCharges)</td>
                            <td class="distance"></td>
                            <td>
                                <a href='treatment?disease={{urlencode($treatments[$i]->DiseaseID)}}&hospital={{urlencode($treatments[$i]->HospitalID)}}'>View</a>
                            </td>
                        </tr>
                        @endfor
                        @if(count($treatments) === 0)
                        <tr> <td> No treatments Found </td> </tr>
                        <script> ("No treatments found, Try searching again with different parameters!"); </script>
                        @endif
                    </tbody>
                </table> 
                {!! $treatments->appends(\Request::except('page'))->render() !!}
            </div>
        </div>
        <div class="card col-sm-12 col-md-12 col-lg-12 col-xl-6 border-success bg-light" style="height: 600px; min-height: 500px; min-width: 320px;">
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
@endsection

<script type="text/javascript">
    $(document).ready(function() {
        //Autocomplete the search form
        let searchParams = new URLSearchParams(window.location.search);
        if (searchParams.has('disease')) {
            $disease.val(searchParams.get('disease'));
        }
        if (searchParams.has('city')) {
            $city.val(searchParams.get('city'));
        }
    });
</script>
