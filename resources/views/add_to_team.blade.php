@extends('layout')

@section('content')
	<x-page-section>
		<x-page-title>
			Add a member to a team
		</x-page-title>
		<x-form-wrapper>
			<x-form 
				action="/api/add_to_team"
			>
				{{-- Dropdown of users --}}
				<x-field-select label="Member" name="user_uuid">
					<option>-</option>
					@foreach ($organisation->users as $user)
						<option value="{{ $user->uuid }}">{{ $user->first_name }} {{ $user->last_name }}</option>
					@endforeach
				</x-field-select>

				{{-- Dropdown of teams --}}
				<x-field-select label="Team" name="team_id">
					<option>-</option>
					@foreach ($organisation->teams as $team)
						<option value="{{ $team->id }}">{{ $team->name }}</option>
					@endforeach
				</x-field-select>

				<x-button-submit>Add to team</x-button-submit>
			</x-form>
		</x-form-wrapper>
	</x-page-section>
@stop