@props([
	'label' => '',
])

<div x-data>
	<x-field-label>
		{{ $label }}
	</x-field-label>
	<div class="flex space-x-3">
		{{ $slot }}
	</div>
</div>