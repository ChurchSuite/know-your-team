@extends('layout')

@section('content')
<x-page-section>
	<x-page-title>
		Register your organisation
	</x-page-title>

	<x-form-wrapper>
		<x-form
			action="/api/organisation"
			formData="{{ json_encode([
				'first_name' => '',
				'last_name' => '',
				'email' => '',
				'job' => '',
				'name' => '',
				'tests' => [],
			]) }}"
			>
			<x-field-text label="Organisation" name="name"/>
			<x-form-divider>About you</x-form-divider>
			<x-field-name firstnameName="first_name" lastnameName="last_name"/>
			<x-field-email label="Email" name="email"/>
			<x-field-text label="Job / Title" name="job"/>
			<x-form-divider>Personality Tests</x-form-divider>
			<x-fieldset legend="Personality Tests">
				<x-field-checkbox label="Enneagram" id="tests_enneagram" name="tests[]" suffix="A popular personality tool, divided into 9 main types, that describe patterns in how people interpret the world and manage their emotions." value="enneagram"/>
				<x-field-checkbox label="Working Genius" id="tests_working_genius" name="tests[]" suffix="A tool commonplace in the workspace that distills any kind of work into six fundamental activities that helps people identify the type of work that makes them flourish." value="working_genius"/>
				<x-field-checkbox label="Myers Briggs" id="tests_myers_briggs" name="tests[]" suffix="Another popular personality type tool which is a self-report inventory designed to identify a person’s strengths, weaknesses and preferences via 16 main types." value="myers_briggs"/>
			</x-fieldset>
			<x-field-error id="tests" />
			<x-button-submit>Set it up!</x-button-submit>
		</x-form>
	</x-form-wrapper>
</x-page-section>
@stop