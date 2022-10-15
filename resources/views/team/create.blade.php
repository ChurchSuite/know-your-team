@extends('layout')

@section('content')
	<x-page-section>
		<x-page-title>
			Add Team
		</x-page-title>
		<x-form-wrapper>
			<x-form action="/api/team">
				<x-field-text label="Name" name="name"/>
				<x-button-submit>Submit</x-button-submit>
			</x-form>
		</x-form-wrapper>
	</x-page-section>
@stop