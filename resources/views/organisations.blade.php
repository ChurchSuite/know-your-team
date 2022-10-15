@extends('layout')

@section('content')
	<ul>
	@foreach($organisations as $organisation)
		<li><a href="/organisation/{{ $organisation->uuid }}">{{ $organisation->name }}</a></li>
	@endforeach
	</ul>
@stop