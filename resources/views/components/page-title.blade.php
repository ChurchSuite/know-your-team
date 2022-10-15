@props(['subtitle' => ''])

<div class="sm:mx-auto sm:w-full sm:max-w-md">
	<img class="mx-auto h-32 w-auto" src="/logo.svg" alt="Know Your Team">
	<h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">{{ $slot }}</h2>
	<p class="mt-2 text-center text-sm text-gray-600">
		{{ $subtitle }}
	</p>
</div>