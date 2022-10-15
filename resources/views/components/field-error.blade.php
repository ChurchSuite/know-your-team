@props(['id' => null])
<p
	class="mt-2 text-sm text-red-600"
	id="{{ $id }}-error"
	x-show="formErrors.{{ $id }}"
	x-text="formErrors.{{ $id }} && formErrors.{{ $id }}[0]"
	>
</p>