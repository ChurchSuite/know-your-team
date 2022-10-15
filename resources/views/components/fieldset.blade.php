@props([
	'legend' => '',
])

<fieldset class="space-y-5">
	<legend class="sr-only">{{ $legend }}</legend>
	{{ $slot }}
</fieldset>
