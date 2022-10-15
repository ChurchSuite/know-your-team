@props([
	'label' => '',
	'name' => '',
	'suffix' => '',
])

<div x-data class="relative flex items-start">
	<div class="flex h-5 items-center">
		<input id="{{ $name }}" aria-describedby="{{ $name }}-description" name="{{ $name }}" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
	</div>
	<div class="ml-3 text-sm">
		<x-field-label id="{{ $name }}">
			{{ $label }}
		</x-field-label>
		<p id="{{ $name }}-description" class="text-gray-500">{{ $suffix }}</p>
	</div>
</div>