@extends('layout')

@section('content')
	New Team Form
	<x-form>
		<x-field-text label="Name" name="name"/>
		<x-field-email label="Email" name="email"/>
		<x-field-password label="Password" name="password"/>
		<x-field-select label="Team" name="team">
			<option value="option_1">Option 1</option>
			<option value="option_2">Option 2</option>
		</x-field-select>
		<x-button-submit>Submit</x-button-submit>
	</x-form>
@stop