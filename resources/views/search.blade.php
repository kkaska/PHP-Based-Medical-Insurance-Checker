@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-2">
            <ul>
                @for($i = 0; $i < count($hospitals); $i++)
                    <li>{{ $hospitals[$i]->Name }}</li>
                @endfor
            </ul>
        </div>
        <div class="col-md-19">HI</div>
    </div>
    {{ $hospitals->links() }}
@endsection