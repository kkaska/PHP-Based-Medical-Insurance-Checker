@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">City</th>
                <th scope="col">State</th>
                <th scope="col">Street Address</th>
                <th scope="col">ZIP Code</th>
            </tr>
            </thead>
            <tbody>
            @for($i = 0; $i < count($hospitals); $i++)
                <tr scope="row">
                    <td>{{ $hospitals[$i]->Name }}</td>
                    <td>{{ $hospitals[$i]->City }}</td>
                    <td>{{ $hospitals[$i]->State }}</td>
                    <td>{{ $hospitals[$i]->StreetAddress }}</td>
                    <td>{{ $hospitals[$i]->Zip }}</td>
                </tr>
            @endfor
            </tbody>
        </table>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6">
                {{ $hospitals->links() }}
            </div>
        </div>
    </div>
@endsection