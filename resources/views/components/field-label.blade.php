@props(['id' => null])

<label class="block text-sm font-medium text-gray-700" for="{{ $id }}">
	{{ $slot }}
</label>