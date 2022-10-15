@props([
	'title' => '',
	'actions' => null,
])


@if (!empty($title) || !empty($actions))
<div class="flex items-baseline justify-between">
	<h2 class="text-xl font-semibold tracking-tight text-gray-900">{{ $title }}</h2>
	@if (!empty($actions))
	<div>
		{{ $actions }}
	</div>
	@endif
</div>
@endif
<ul class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">
	{{ $slot }}
</ul>