@extends('layouts.app')

@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js" integrity="sha384-+GtXzQ3eTCAK6MNrGmy3TcOujpxp7MnMAi6nvlvbZlETUcZeCk7TDwvlCw9RiV6R" crossorigin="anonymous"></script>
    <div class="container">
        <div class="row justify-content-center mb-3 mt-3">
            <h2>Search results for: <span class="text-muted">"{{ $disease }}"</span> in <span class="text-muted">"{{ $city }}"</span></h2>
        </div>
        <table class="table table-striped table-hover">
            <thead class="table-primary">
            <tr>
                <th scope="col" class="align-middle">Disease Name</th>
                <th scope="col" class="align-middle">Hospital Name</th>
                <th scope="col" class="align-middle">City</th>
                <th scope="col" class="align-middle">Average Charges</th>
                <th scope="col" class="align-middle">Year</th>
            </tr>
            </thead>
            <tbody>
            @for($i = 0; $i < count($treatments); $i++)
                <tr scope="row">
                    <td>{{ $treatments[$i]->DiseaseName }}</td>
                    <td>{{ $treatments[$i]->HospitalName }}</td>
                    <td>{{ $treatments[$i]->City }}</td>
                    <td>@parseMoney($treatments[$i]->AverageCoveredCharges)</td>
                    <td>{{ $treatments[$i]->Year }}</td>
                </tr>
            @endfor
            </tbody>
        </table>
        <div class="row justify-content-center">
                {{ $treatments->appends(request()->input())->links() }}
        </div>
    </div>
@endsection