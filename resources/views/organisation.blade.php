@extends('layout')

@section('content')
<x-page-section>
	{{-- Results --}}
	<x-dashboard-widget-wrapper>
		<x-dashboard-widget title="Test Results">
			@foreach($organisation->tests as $test)
				<li>{{ $test->test_identifier }}</li>
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
					<a href="#" class="absolute inset-0"></a>
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
@stop