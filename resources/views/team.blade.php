@extends('layout')

@section('content')
	<x-form
		action="/api/team"
	>
		<x-field-text label="Name" name="name"/>
		<x-button-submit>Submit</x-button-submit>
	</x-form>
@stop