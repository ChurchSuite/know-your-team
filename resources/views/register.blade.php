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
			<x-field-email label="Email" name="email"/>
			<x-field-text label="Job / Title" name="job"/>
			<x-form-divider>Personality Tests</x-form-divider>
			<x-fieldset legend="Personality Tests">
				<x-field-checkbox label="Enneagram" id="tests_enneagram" name="tests[]" suffix="stuff" value="enneagram"/>
				<x-field-checkbox label="Working Genius" id="tests_working_genius" name="tests[]" suffix="stuff" value="working_genius"/>
				<x-field-checkbox label="Myers Briggs" id="tests_myers_briggs" name="tests[]" suffix="stuff" value="myers_briggs"/>
			</x-fieldset>
			<x-button-submit>Set it up!</x-button-submit>
		</x-form>
	</x-form-wrapper>
</x-page-section>
@stop