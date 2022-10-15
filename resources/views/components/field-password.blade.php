@props([
	'label' => '',
	'name' => '',
	'placeholder' => '',
])

<x-field-input
	label="{{ $label }}"
	name="{{ $name }}"
	placeholder="{{ $placeholder }}"
	type="password"
	/>