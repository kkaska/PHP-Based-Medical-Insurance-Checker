@extends('layouts.app')

@section('content')
    <ul>
    @for($i = 0; $i < count($hospitals); $i++)
        <li>{{ $hospitals[$i]->Name }}</li>
    @endfor
    </ul>
@endsection