@extends('layout')

@section('content')
	<x-page-section>
		<x-page-title>
			Add User
		</x-page-title>

		<x-form-wrapper>
			<x-form
				action="/api/user"
			>
				<x-field-text label="First Name" name="first_name"/>
				<x-field-text label="Last Name" name="last_name"/>
				<x-field-email label="Email" name="email"/>
				<x-field-text label="Job" name="job"/>
				<x-button-submit>Submit</x-button-submit>
			</x-form>
		</x-form-wrapper>
	</x-page-section>
@stop