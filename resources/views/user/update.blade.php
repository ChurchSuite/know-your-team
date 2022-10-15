@extends('layout')

@section('content')
	<x-page-section>
		<x-page-title>
			Edit User
		</x-page-title>
		<x-form-wrapper>
			<x-form
				action="/api/user/{{ $user->uuid }}"
				formData="{{ json_encode([
					'first_name' => $user->first_name,
					'last_name' => $user->last_name,
					'email' => $user->email,
					'job' => $user->job,
					'profile_picture' => $user->profile_picture,
				]) }}"
				method="put"
				>
				<img class="mx-auto h-40 w-40 flex-shrink-0 rounded-full bg-gray-300" :src="formData.profile_picture" alt="">
				<x-field-name label="Name" firstnameName="first_name" lastnameName="last_name"/>
				<x-field-email label="Email" name="email"/>
				<x-field-text label="Job" name="job"/>
				<x-field-text label="Profile Picture" name="profile_picture"/>
				<x-button-submit>Submit</x-button-submit>
			</x-form>
		</x-form-wrapper>
	</x-page-section>
@stop