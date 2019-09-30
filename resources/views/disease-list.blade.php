@extends('layouts.app')

@section('content')
@include('layouts.partials.search')
<style>
    .mapsFix {
        padding-top: 100%;
        max-height: 500px;
    }
    .table {
      max-height: 500px;
      overflow-y:scroll;
      display:block;
    }
 </style>
<div class="container-fluid mt-3">
{{-- <p>This page needs fixed a bit, the cards need to be responsive</p>
<p>Map is also completely unconnected -> to do later</p>
<div class="container"> --}}
    <div class="card-group">
        <div class="card col overflow:auto border-success bg-light">
            <div class="card-body table-responsive">
                <table class="table table-hover">
                    <tr>

                        <th scope="col" class="align-middle">Treatment</th>
                        <th scope="col" class="align-middle">Hospital</th>
                        <th scope="col" class="align-middle">City</th>
                        <th scope="col" class="align-middle">@sortablelink('AverageCharges', 'Cost')</th>
                        <th scope="col" class="align-middle">Distance</th>
                    </tr>

                    <script>
                        var position = {lat: {{ json_encode($userLatitude) }}, lng: {{ json_encode($userLongitude) }}};   //Get Lat and Lng from laravel's session
                    </script>

                    <tbody>
                    @for($i = 0; $i < count($treatments); $i++)
                        <tr class="hospital-data" scope="row" data-hospital-address="{{ $treatments[$i]->HospitalAddress }}" data-hospital-postCode="{{ $treatments[$i]->HospitalPostCode }}">
                            <td>{{ $treatments[$i]->DiseaseName }}</td>
                            <td class="hospital-name">{{ $treatments[$i]->HospitalName }}</td>
                            <td class="hospital-city">{{ $treatments[$i]->City }}</td>
                            <td>@parseMoney($treatments[$i]->AverageCharges)</td>
                            <td id= {{$i}}></td>
                        </tr>



                    @endfor
                    @if(count($treatments) === 0)
                      <tr> <td> No treatments Found </td> </tr>
                      <script> alert("No treatments found, Try searching again with different parameters!"); </script>
                    @endif

                    </tbody>
                </table>

                {!! $treatments->appends(\Request::except('page'))->render() !!}
            </div>

            <script src="{{ URL::asset('js/maps-distance.js') }}">
            alert("PING!");</script>
        </div>
        <div class="card col-lg-5 border-success bg-light">
            <div class="card-body">
                <!-- Google Maps -->
                <div id="map" class="mapsFix"></div>

                <script src="{{ URL::asset('js/maps-list.js') }}"></script>
            </div>
        </div>
    </div>
</div>
@endsection
