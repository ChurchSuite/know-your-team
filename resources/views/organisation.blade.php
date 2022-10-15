@extends('layout')

@section('content')
<x-page-section>
	{{-- Results --}}
	<x-dashboard-widget-wrapper>
		<x-dashboard-widget title="Test Results">
			@foreach($organisation->tests as $test)
				<div class="flex w-full items-center justify-between space-x-6 p-6">
					<div class="flex-1 truncate">
						<div class="flex items-center space-x-3">
							<h3 class="truncate text-sm font-medium text-gray-900">{{ $test->name() }}</h3>
						</div>
					</div>
				</div>
			@endforeach
		</x-dashboard-widget>
	</x-dashboard-widget-wrapper>
	{{-- Users --}}
	<x-dashboard-widget-wrapper>
		<x-dashboard-widget title="User">
			@foreach($organisation->users as $user)
				<div class="relative">
					<div class="flex w-full items-center justify-between space-x-6 p-6">
						<div class="flex-1 truncate">
							<div class="flex items-baseline space-x-3">
								<h3 class="truncate text-base font-medium text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</h3>
								<span class="space-x-1">
									@foreach ($user->teams as $team)
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
					<a href="/user/{{ $user->uuid }}" class="absolute inset-0"></a>
				</div>
			@endforeach
			<x-slot name="actions">
				<span class="isolate inline-flex rounded-md shadow-sm">
					<a href="/user" class="first:rounded-l-md last:rounded-r-md relative inline-flex items-center border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 space-x-2">
						<svg width="16" height="16" fill="none" viewBox="0 0 24 24">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 5.75V18.25"></path>
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.25 12L5.75 12"></path>
						</svg>
						User
					</a>
				</span>
			</x-slot>
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
			<x-slot name="actions">
				<span class="isolate inline-flex rounded-md shadow-sm">
					<a href="/team" class="first:rounded-l-md last:rounded-r-md relative inline-flex items-center border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500 space-x-2">
						<svg width="16" height="16" fill="none" viewBox="0 0 24 24">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 5.75V18.25"></path>
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.25 12L5.75 12"></path>
						</svg>
						Team
					</a>
					<a href="/add_to_team" class="first:rounded-l-md last:rounded-r-md relative -ml-px inline-flex items-center border border-gray-300 bg-white px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500">
						<svg width="16" height="16" fill="none" viewBox="0 0 24 24">
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 5.75V18.25"></path>
							<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M18.25 12L5.75 12"></path>
						</svg>
						Team User
					</a>
				</span>
			</x-slot>
		</x-dashboard-widget>
	</x-dashboard-widget-wrapper>
</x-page-section>
@stop