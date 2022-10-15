@extends('layout')

@section('content')
<x-page-section>
	<x-page-title>
		Register your organisation
	</x-page-title>

	<x-form-wrapper>
		<x-form action="/api/organisation">
			<x-field-text label="Organisation" name="name"/>
			<x-form-divider>About you</x-form-divider>
			<x-field-name firstnameName="first_name" lastnameName="last_name"/>
			<x-field-text label="Email" name="email" type="email"/>
			<x-field-text label="Job / Title" name="job"/>
			<x-form-divider>Personality Tests</x-form-divider>
			<x-fieldset legend="Personality Tests">
				<x-field-checkbox label="Enneagram" name="tests[enneagram]" suffix="stuff"/>
				<x-field-checkbox label="Working Genius" name="tests[working_genius]" suffix="stuff"/>
				<x-field-checkbox label="Myers Briggs" name="tests[myers_briggs]" suffix="stuff"/>
			</x-fieldset>
			<x-button-submit>Set it up!</x-button-submit>
		</x-form>
	</x-form-wrapper>
</x-page-section>
@stop