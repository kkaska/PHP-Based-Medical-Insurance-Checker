@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">Name</th>
            </tr>
            </thead>
            <tbody>
            @for($i = 0; $i < count($diseases); $i++)
                <tr scope="row">
                    <td>{{ $diseases[$i]->Name }}</td>
                </tr>
            @endfor
            </tbody>
        </table>
        <div class="row justify-content-center">
                {{ $diseases->appends(request()->input())->links() }}
        </div>
    </div>
@endsection