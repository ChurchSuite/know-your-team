@extends('layout')

@section('content')
	<x-page-section>
		<x-page-title>
			Add User
		</x-page-title>
		<x-form-wrapper>
			<x-form 
				action="/api/user"
				formData="{{ json_encode([
					'profile_picture' => 'https://3znvnpy5ek52a26m01me9p1t-wpengine.netdna-ssl.com/wp-content/uploads/2017/07/noimage_person.png',
				]) }}"
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