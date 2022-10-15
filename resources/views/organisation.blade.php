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
<x-page-section>
	<x-page-title>
		{{ $organisation->name }}
	</x-page-title>

	<x-form-wrapper>
		<x-form
			action="/api/organisation/{{ $organisation->uuid }}"
			method="put"
			formData="{{ json_encode([
				'name' => $organisation->name
			]) }}"
			>
			<x-field-text label="Name" name="name"/>
			<x-button-submit>Edit</x-button-submit>
		</x-form>
	</x-form-wrapper>
</x-page-section>
@stop