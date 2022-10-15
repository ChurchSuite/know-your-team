@extends('layout')

@section('content')
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