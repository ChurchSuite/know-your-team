@props([
	'label' => '',
	'name' => '',
])

<div>
	<x-field-label id="{{ $name }}">{{ $label }}</x-field-label>
	<select
		class="mt-1 block w-full rounded-md border-gray-300 py-2 pl-3 pr-10 text-base focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
		id="{{ $name }}"
		name="{{ $name }}"
		x-model="formData.{{ $name }}"
		>
		{{ $slot }}
	</select>
	<x-field-error id="{{ $name }}" />
</div>