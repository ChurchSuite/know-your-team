@extends('layout')

@section('content')
	<x-page-section>
		<x-page-title>
			Submit Test Results
		</x-page-title>
		<x-form-wrapper>
			<x-form
				action="/api/submit"
				formData="{{ json_encode([
					'test_identifier' => $test_identifier ?? $organisation->tests->first()->test_identifier,
					'enneagram' => [
						'type' => $result->type ?? null,
						'wing' => $result->wing ?? null,
					],
					'myers_briggs' => [
						'ie' => $result->ie ?? null,
						'sn' => $result->sn ?? null,
						'tf' => $result->tf ?? null,
						'jp' => $result->jp ?? null,
					],
					'working_genius' => [
						'genius1' => $result->genius1 ?? null,
						'genius2' => $result->genius2 ?? null,
						'competency1' => $result->competency1 ?? null,
						'competency2' => $result->competency2 ?? null,
						'frustration1' => $result->frustration1 ?? null,
						'frustration2' => $result->frustration2 ?? null,
					],
				]) }}"
			>
				{{-- Dropdown of users --}}
				@if (is_null($user_uuid ?? null))
					<x-field-select label="Member" name="user_uuid">
						@foreach ($organisation->users as $user)
							<option value="{{ $user->uuid }}">{{ $user->first_name }} {{ $user->last_name }}</option>
						@endforeach
					</x-field-select>
				@else
					<input type="hidden" name="user_uuid" value="{{ $user_uuid }}">
				@endif

				{{-- Dropdown of tests --}}
				@if (is_null($test_identifier ?? null))
					<x-field-select label="Test" name="test_identifier">
						@foreach ($organisation->tests as $test)
							<option value="{{ $test->test_identifier }}">{{ $test->name() }}</option>
						@endforeach
					</x-field-select>
				@else
					<input type="hidden" name="test_identifier" value="{{ $test_identifier }}">
				@endif


				<div class="space-y-2" x-show="formData.test_identifier == 'enneagram'">
					<x-form-divider>Enneagram</x-form-divider>
					<x-field-select label="Type" name="enneagram[type]">
						<option>-</option>
						@for ($i = 1; $i <= 9; $i++)
							<option value="{{ $i }}">{{ $i }}</option>
						@endfor
					</x-field-select>
					<x-field-select label="Wing" name="enneagram[wing]">
						<option>-</option>
						@for ($i = 1; $i <= 9; $i++)
							<option value="{{ $i }}">{{ $i }}</option>
						@endfor
					</x-field-select>
				</div>

				<div class="space-y-2" x-show="formData.test_identifier == 'myers_briggs'">
					<x-form-divider>Myers Briggs</x-form-divider>
					<x-field-select name="myers_briggs[ie]">
						<option>-</option>
						<option value="I">Introvert</option>
						<option value="E">Extravert</option>
					</x-field-select>
					<x-field-select name="myers_briggs[sn]">
						<option>-</option>
						<option value="S">Sensing</option>
						<option value="N">Intuitive</option>
					</x-field-select>
					<x-field-select name="myers_briggs[tf]">
						<option>-</option>
						<option value="T">Thinking</option>
						<option value="F">Feeling</option>
					</x-field-select>
					<x-field-select name="myers_briggs[jp]">
						<option>-</option>
						<option value="J">Judging</option>
						<option value="P">Perceiving</option>
					</x-field-select>
				</div>

				<div class="space-y-2" x-show="formData.test_identifier == 'working_genius'">
					<x-form-divider>Working Genius</x-form-divider>
					<x-field-select label="Genius 1" name="working_genius[genius1]">
						<option>-</option>
						<option value="wonder">Wonder</option>
						<option value="invention">Invention</option>
						<option value="discernment">Discernment</option>
						<option value="galvanising">Galvanising</option>
						<option value="enablement">Enablement</option>
						<option value="tenacity">Tenacity</option>
					</x-field-select>
					<x-field-select label="Genius 2" name="working_genius[genius2]">
						<option>-</option>
						<option value="wonder">Wonder</option>
						<option value="invention">Invention</option>
						<option value="discernment">Discernment</option>
						<option value="galvanising">Galvanising</option>
						<option value="enablement">Enablement</option>
						<option value="tenacity">Tenacity</option>
					</x-field-select>
					<x-field-select label="Competency 1" name="working_genius[competency1]">
						<option>-</option>
						<option value="wonder">Wonder</option>
						<option value="invention">Invention</option>
						<option value="discernment">Discernment</option>
						<option value="galvanising">Galvanising</option>
						<option value="enablement">Enablement</option>
						<option value="tenacity">Tenacity</option>
					</x-field-select>
					<x-field-select label="Competency 2" name="working_genius[competency2]">
						<option>-</option>
						<option value="wonder">Wonder</option>
						<option value="invention">Invention</option>
						<option value="discernment">Discernment</option>
						<option value="galvanising">Galvanising</option>
						<option value="enablement">Enablement</option>
						<option value="tenacity">Tenacity</option>
					</x-field-select>
					<x-field-select label="Frustration 1" name="working_genius[frustration1]">
						<option>-</option>
						<option value="wonder">Wonder</option>
						<option value="invention">Invention</option>
						<option value="discernment">Discernment</option>
						<option value="galvanising">Galvanising</option>
						<option value="enablement">Enablement</option>
						<option value="tenacity">Tenacity</option>
					</x-field-select>
					<x-field-select label="Frustration 2" name="working_genius[frustration2]">
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