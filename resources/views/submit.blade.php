@extends('layout')

@section('content')
	<x-page-section>
		<x-page-title>
			Submit Test Results
		</x-page-title>
		<x-form-wrapper>
			<x-form 
				action="/api/results"
				formData="{{ json_encode([
					'test_identifier' => $organisation->tests->first()->test_identifier,
				]) }}"
			>
				{{-- Dropdown of users --}}
				<x-field-select label="Member" name="user_uuid">
					@foreach ($organisation->users as $user)
						<option value="{{ $user->uuid }}">{{ $user->first_name }} {{ $user->last_name }}</option>
					@endforeach
				</x-field-select>

				{{-- Dropdown of tests --}}
				<x-field-select label="Member" name="test_identifier">
					@foreach ($organisation->tests as $test)
						<option value="{{ $test->test_identifier }}">{{ $test->test_identifier }}</option>
					@endforeach
				</x-field-select>

			
				<div x-show="formData.test_identifier == 'enneagram'">
				<x-form-divider>Enneagram</x-form-divider>
					Enneagram
				</div>

				<div x-show="formData.test_identifier == 'myers_briggs'">
				<x-form-divider>Myers Briggs</x-form-divider>
					Myers Briggs
				</div>

				<div x-show="formData.test_identifier == 'working_genius'">
				<x-form-divider>Working Genius</x-form-divider>
					Working Genius
				</div>
				<x-button-submit>Submit</x-button-submit>
			</x-form>
		</x-form-wrapper>
	</x-page-section>
@stop