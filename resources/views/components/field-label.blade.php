@props(['id' => null])

<label class="block text-sm font-medium text-gray-700" for="{{ $id }}" x-on:click="errors.{{ $id }} = 'Something went horribly wrong!'">
	{{ $slot }}
</label>