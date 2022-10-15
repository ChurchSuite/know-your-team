@props([
	'label' => '',
	'id' => '',
	'name' => '',
	'suffix' => '',
	'value' => '',
])

<div x-data class="relative flex items-start">
	<div class="flex h-5 items-center">
		<input
			id="{{ $id }}"
			aria-describedby="{{ $id }}-description"
			name="{{ $name }}"
			type="checkbox"
			class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
			value="{{ $value }}"
			x-model="formData.{{ str_replace('[]', '', $name) }}"
			>
	</div>
	<div class="ml-3 text-sm">
		<x-field-label id="{{ $id }}">
			{{ $label }}
		</x-field-label>
		<p id="{{ $id }}-description" class="text-gray-500">{{ $suffix }}</p>
	</div>
</div>