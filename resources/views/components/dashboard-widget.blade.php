@props([
	'title' => '',
])
@if (!empty($title))
	<h2 class="text-xl font-semibold tracking-tight text-gray-900">{{ $title }}</h2>
@endif
<li class="col-span-1 divide-y divide-gray-200 rounded-lg bg-white shadow">
	{{ $slot }}
</li>