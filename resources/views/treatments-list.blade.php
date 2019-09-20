@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Disease Name</th>
                <th scope="col">Hospital Name</th>
                <th scope="col">Average Charges</th>
                <th scope="col">Year</th>
            </tr>
            </thead>
            <tbody>
            @for($i = 0; $i < count($treatments); $i++)
                <tr scope="row">
                    <td>{{ $treatments[$i]->DiseaseName }}</td>
                    <td>{{ $treatments[$i]->HospitalName }}</td>
                    <td>{{ $treatments[$i]->AverageCoveredCharges }}</td>
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