<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Know Your Team</title>
		<script src="https://unpkg.com/tailwindcss-jit-cdn"></script>
		<script src="https://unpkg.com/alpinejs@3.10.3" defer=""></script>
    </head>
    <body class="antialiased bg-gray-50">
		<div x-data="{ menuOpen: false }"class="relative bg-white">
			<div class="pointer-events-none absolute inset-0 z-30 shadow" aria-hidden="true"></div>
			<div class="relative z-20">
				<div class="mx-auto flex max-w-7xl items-center justify-between px-4 py-5 sm:px-6 sm:py-4 md:justify-start md:space-x-10 lg:px-8">
					<div>
						<a href="#" class="flex">
							<span class="sr-only">Your Company</span>
							<img class="h-8 w-auto sm:h-10" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="">
						</a>
					</div>
					<div class="-my-2 -mr-2 md:hidden">
						<button x-on:click="menuOpen = true" type="button" class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-expanded="false">
							<span class="sr-only">Open menu</span>
							<svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
							</svg>
						</button>
					</div>
					<div class="hidden md:flex md:flex-1 md:items-center md:justify-end">
						<nav class="flex space-x-6">
							@include('partials.menu')
						</nav>
					</div>
				</div>
			</div>
			<div x-show="menuOpen" x-transition class="absolute inset-x-0 top-0 z-30 origin-top-right transform p-2 transition md:hidden">
				<div class="divide-y-2 divide-gray-50 rounded-lg bg-white shadow-lg ring-1 ring-black ring-opacity-5">
					<div class="px-5 pt-5 pb-6 sm:pb-8">
						<div class="flex items-center justify-between">
						<div>
							<img class="h-8 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
						</div>
						<div class="-mr-2">
							<button x-on:click="menuOpen = false" type="button" class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
								<span class="sr-only">Close menu</span>
								<svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
								</svg>
							</button>
						</div>
						</div>
					</div>
					<div class="py-6 px-5">
						<div class="grid grid-cols-1 gap-4">
							@include('partials.menu')
						</div>
					</div>
				</div>
			</div>
		</div>

		@yield('content')
    </body>
</html>