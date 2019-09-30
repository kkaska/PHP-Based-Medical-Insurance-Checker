@extends('layouts.app')

@section('content')
@include('layouts.partials.search')

<body>
	@foreach ($years as $year) 

	Year: {{ $year->Year }}
	Cost: {{ $year->AverageTotalPayments }} 

@endforeach</body>

@endsection