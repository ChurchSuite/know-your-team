<div class="relative py-1">
	<div class="absolute inset-0 flex items-center px-0.5">
	  <div class="w-full border-t border-gray-200"></div>
	</div>
	<div class="relative flex justify-center text-sm">
		@if (!empty($slot))
			<span class="bg-white px-2 text-gray-500">{{ $slot }}</span>
		@endif
	</div>
</div>