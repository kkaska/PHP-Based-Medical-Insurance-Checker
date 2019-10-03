@extends('layouts.app')

@section('content')
    <div class="container-fluid mb-3 mt-3">
        <div class="card-group">
            <div class="card overflow-auto border-success bg-light" style="min-height: 700px">
                <div class="card-body pl-3 pr-3">
                    <h1 class="text-center text-dark">{{$diseaseName}}</h1>
                    <hr class="my-4 w-75">
                    <div class="row">
                        <div class="col-md-6">
                            <h2 class="text-center">{{$hospital->Name}}</h2>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <h4>
                                        <span class="fa fa-map-marker text-info"></span>
                                        Address:
                                    </h4>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled h5">
                                        <li>{{$hospital->StreetAddress}}</li>
                                        <li>{{$hospital->City}}, {{$hospital->State}}</li>
                                        <li>{{$hospital->Zip}}</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <h4>
                                        <span class="fa fa-dollar text-info"></span>
                                        Average Covered Charges:
                                    </h4>
                                </div>
                                <div class="col-md-6 h5">
                                    @parseMoney($averageCharges)
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <h4>
                                        <span class="fa fa-dollar text-info"></span>
                                        Average Payments:
                                    </h4>
                                </div>
                                <div class="col-md-6">
                                    <ul class="list-unstyled h5">
                                        <li><strong>Medicare:</strong> @parseMoney($averageMedicare)</li>
                                        <li><strong>Total:</strong> @parseMoney($averageTotal)</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <h4>
                                        <span class="fa fa-male text-info"></span>
                                        Average Admissions:
                                    </h4>
                                </div>
                                <div class="col-md-6 h5">
                                    {{$averageAdmissions}} people
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <h4>
                                        <span class="fa fa-calendar text-info"></span>
                                        Years:
                                    </h4>
                                </div>
                                <div class="col-md-6 h5">
                                    @if($lastYear)
                                        {{ $firstYear }} - {{ $lastYear }}
                                    @else
                                        {{ $firstYear  }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a href="#covered" class="nav-link active" data-toggle="tab">Average Covered Charges</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#total" class="nav-link" data-toggle="tab">Total Payments</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#medicare" class="nav-link" data-toggle="tab">Medicare Payments</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#patients" class="nav-link" data-toggle="tab">Patients</a>
                                </li>
                            </ul>
                            <div class="tab-content mt-4">
                                <div class="tab-pane active show" id="covered">
                                    <canvas id="covered-chart"></canvas>
                                </div>
                                <div class="tab-pane" id="total">
                                    <canvas id="total-chart"></canvas>
                                </div>
                                <div class="tab-pane" id="medicare">
                                    <canvas id="medicare-chart"></canvas>
                                </div>
                                <div class="tab-pane" id="patients">
                                    <canvas id="patients-chart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{URL::asset('js/treatment-view.js')}}"></script>
@endsection