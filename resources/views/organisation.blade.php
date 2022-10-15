@extends('layout')

@section('content')
	<h1>Teams</h1>
	<ul>
		@foreach($organisation->teams as $team)
			<li>{{ $team->name }}</li>
		@endforeach
	</ul>
	<br>

	<h1>Users</h1>
	<ul>
		@foreach($organisation->users as $user)
			<li>{{ $user->first_name }} {{ $user->last_name }}</li>
		@endforeach
	</ul>
@stop