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
					<x-field-select label="Type" name="type">
						<option>-</option>
						@for ($i = 1; $i <= 9; $i++)
							<option value="{{ $i }}">{{ $i }}</option>
						@endfor
					</x-field-select>
					<x-field-select label="Wing" name="wing">
						<option>-</option>
						@for ($i = 1; $i <= 9; $i++)
							<option value="{{ $i }}">{{ $i }}</option>
						@endfor
					</x-field-select>
				</div>

				<div x-show="formData.test_identifier == 'myers_briggs'">
				<x-form-divider>Myers Briggs</x-form-divider>
				<x-field-select name="ie">
					<option>-</option>
					<option value="I">Introvert</option>
					<option value="E">Extravert</option>
				</x-field-select>
				<x-field-select name="sn">
					<option>-</option>
					<option value="S">Sensing</option>
					<option value="N">Intuitive</option>
				</x-field-select>
				<x-field-select name="tf">
					<option>-</option>
					<option value="T">Thinking</option>
					<option value="F">Feeling</option>
				</x-field-select>
				<x-field-select name="jp">
					<option>-</option>
					<option value="J">Judging</option>
					<option value="P">Perceiving</option>
				</x-field-select>
				</div>

				<div x-show="formData.test_identifier == 'working_genius'">
				<x-form-divider>Working Genius</x-form-divider>
				<x-field-select label="Genius 1" name="genius1">
					<option>-</option>
					<option value="wonder">Wonder</option>
					<option value="invention">Invention</option>
					<option value="discernment">Discernment</option>
					<option value="galvanising">Galvanising</option>
					<option value="enablement">Enablement</option>
					<option value="tenacity">Tenacity</option>
				</x-field-select>
				<x-field-select label="Genius 2" name="genius2">
					<option>-</option>
					<option value="wonder">Wonder</option>
					<option value="invention">Invention</option>
					<option value="discernment">Discernment</option>
					<option value="galvanising">Galvanising</option>
					<option value="enablement">Enablement</option>
					<option value="tenacity">Tenacity</option>
				</x-field-select>
				<x-field-select label="Competency 1" name="competency1">
					<option>-</option>
					<option value="wonder">Wonder</option>
					<option value="invention">Invention</option>
					<option value="discernment">Discernment</option>
					<option value="galvanising">Galvanising</option>
					<option value="enablement">Enablement</option>
					<option value="tenacity">Tenacity</option>
				</x-field-select>
				<x-field-select label="Competency 2" name="competency2">
					<option>-</option>
					<option value="wonder">Wonder</option>
					<option value="invention">Invention</option>
					<option value="discernment">Discernment</option>
					<option value="galvanising">Galvanising</option>
					<option value="enablement">Enablement</option>
					<option value="tenacity">Tenacity</option>
				</x-field-select>
				<x-field-select label="Frustration 1" name="frustration1">
					<option>-</option>
					<option value="wonder">Wonder</option>
					<option value="invention">Invention</option>
					<option value="discernment">Discernment</option>
					<option value="galvanising">Galvanising</option>
					<option value="enablement">Enablement</option>
					<option value="tenacity">Tenacity</option>
				</x-field-select>
				<x-field-select label="Frustration 2" name="frustration2">
					<option>-</option>
					<option value="wonder">Wonder</option>
					<option value="invention">Invention</option>
					<option value="discernment">Discernment</option>
					<option value="galvanising">Galvanising</option>
					<option value="enablement">Enablement</option>
					<option value="tenacity">Tenacity</option>
				</x-field-select>

				</div>
				<x-button-submit>Submit</x-button-submit>
			</x-form>
		</x-form-wrapper>
	</x-page-section>
@stop