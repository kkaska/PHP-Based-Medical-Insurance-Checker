@extends('layouts.app')
@section('pageTitle', 'View Data')
@section('content')
@include('layouts.partials.search')

<body>
	@foreach ($years as $year) 

	Year: {{ $year->Year }}
	Cost: {{ $year->AverageTotalPayments }} 

@endforeach</body>

@endsection