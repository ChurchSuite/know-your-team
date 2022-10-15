@extends('layout')

@section('content')
<x-page-section>
	{{-- Results --}}
	<x-dashboard-widget-wrapper>
		<x-dashboard-widget title="Test Results">
			{{-- @foreach($testResults as $testResult)

	<h1>Users</h1>
	<ul>
		@foreach($organisation->users as $user)
			<li>{{ $user->first_name }} {{ $user->last_name }}</li>
		@endforeach
	</ul>

	<h1>Tests</h1>
	<ul>
		@foreach($organisation->tests as $test)
			<li>{{ $test->test_identifier }}</li>
		@endforeach
	</ul>
			@endforeach --}}
		</x-dashboard-widget>
	</x-dashboard-widget-wrapper>
	{{-- Users --}}
	<x-dashboard-widget-wrapper>
		<x-dashboard-widget title="User">
			@foreach($organisation->users as $user)
				<div class="flex w-full items-center justify-between space-x-6 p-6">
					<div class="flex-1 truncate">
						<div class="flex items-center space-x-3">
							<h3 class="truncate text-sm font-medium text-gray-900">{{ $user->name }}</h3>
							<span class="space-x-1">
								@foreach ($user->teams() as $team)
									@if ($team)
										<span class="inline-block flex-shrink-0 rounded-full bg-green-100 px-2 py-0.5 text-xs font-medium text-green-800">{{ $team->name }}</span>
									@endif
								@endforeach
							</span>
						</div>
						<p class="mt-1 truncate text-sm text-gray-500">{{ $user->job }}</p>
					</div>
					<img class="h-10 w-10 flex-shrink-0 rounded-full bg-gray-300" src="{{ $user->url }}" alt="">
				</div>
			@endforeach
		</x-dashboard-widget>
	</x-dashboard-widget-wrapper>
	{{-- Teams --}}
	<x-dashboard-widget-wrapper>
		<x-dashboard-widget title="Teams">
			@foreach($organisation->teams as $team)
				<div class="flex w-full items-center justify-between space-x-6 p-6">
					<div class="flex-1 truncate">
						<div class="flex items-center space-x-3">
							<h3 class="truncate text-sm font-medium text-gray-900">{{ $team->name }}</h3>
						</div>
					</div>
				</div>
			@endforeach
		</x-dashboard-widget>
	</x-dashboard-widget-wrapper>

</x-page-section>
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