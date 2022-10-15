@extends('layout')

@section('content')
	<x-page-section>
		<x-page-title>
			Edit Team
		</x-page-title>
		<x-form-wrapper>
			<x-form
				action="/api/team/{{ $team->id }}"
				formData="{{ json_encode([
					'name' => $team->name,
				]) }}"
				method="put"
				>
				<x-field-text label="Name" name="name"/>
				<x-button-submit>Submit</x-button-submit>
			</x-form>
		</x-form-wrapper>
	</x-page-section>
@stop