@extends('layout')

@section('content')
	@foreach($organisations as $organisation)
		{{ $organisation->name }}
	@endforeach
@stop