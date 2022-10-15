@props([
	'label' => 'Name',
	'firstnameName' => '',
	'lastnameName' => '',
	'placeholder' => '',
])

<x-field-input-group label="{{ $label }}">
	<x-field-input
		name="{{ $firstnameName }}"
		placeholder="First Name"
		/>
	<x-field-input
		name="{{ $lastnameName }}"
		placeholder="Last Name"
		/>
</x-field-input-group>
