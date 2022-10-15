@props(['id' => null])
<p
	class="mt-2 text-sm text-red-600"
	id="{{ $id }}-error"
	x-show="errors && errors.{{ $id }}"
	x-text="errors && errors.{{ $id }}"
	>
</p>