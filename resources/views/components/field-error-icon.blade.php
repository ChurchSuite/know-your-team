@props(['id' => null])
<div
	class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-red-500"
	x-show="formErrors && formErrors.{{ $id }}"
	>
	<svg width="24" height="24" fill="none" viewBox="0 0 24 24">
		<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 13V15"></path>
		<circle cx="12" cy="9" r="1" fill="currentColor"></circle>
		<circle cx="12" cy="12" r="7.25" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></circle>
	</svg>
</div>