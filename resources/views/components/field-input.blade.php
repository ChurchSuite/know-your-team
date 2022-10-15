@props([
	'label' => '',
	'name' => '',
	'placeholder' => '',
	'type' => 'text',
])

<div x-data>
	<x-field-label id="{{ $name }}">
		{{ $label }}
	</x-field-label>
	<div class="relative mt-1 rounded-md shadow-sm">
		{{ $slot }}
		<input
			x-bind:class="{
				'border-red-300 text-red-900 placeholder-red-300 focus:border-red-500 focus:ring-red-500': errors && errors.{{ $name }}
			}"
			class="border-gray-300 block w-full rounded-md pr-10 focus:outline-none sm:text-sm"
			id="{{ $name }}"
			name="{{ $name }}"
			placeholder="{{ $placeholder }}"
			type="{{ $type }}"
			x-model="formData.{{ $name }}"
			/>
		<x-field-error-icon id="{{ $name }}" />
	</div>
	<x-field-error id="{{ $name }}" />
</div>