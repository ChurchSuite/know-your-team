@extends('layout')

@section('content')
<x-page-section>
	<x-page-title>
		Register your organisation
	</x-page-title>

	<x-form-wrapper>
		<x-form action="/api/register">
			<x-field-text label="Organisation" name="name"/>
			<x-form-divider>About you</x-form-divider>
			<x-field-name firstnameName="first_name" lastnameName="last_name"/>
			<x-field-text label="Email" name="email" type="email"/>
			<x-field-text label="Job / Title" name="job"/>
			<x-form-divider></x-form-divider>
			{{-- Personality Type Checkboxes --}}
			<x-button-submit>Set it up!</x-button-submit>
		</x-form>
	</x-form-wrapper>
</x-page-title>
@stop