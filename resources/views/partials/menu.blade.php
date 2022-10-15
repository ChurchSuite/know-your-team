<a href="/user" class="rounded-md text-base font-medium text-gray-700 hover:text-indigo-600">User</a>
<a href="/team" class="rounded-md text-base font-medium text-gray-700 hover:text-indigo-600">Team</a>
<a href="/submit" class="rounded-md text-base font-medium text-gray-700 hover:text-indigo-600">Submit</a>
@if (!empty(Session::get('organisation_id')))
<a href="/settings" class="rounded-full bg-white text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
	<span class="sr-only">Settings</span>
	<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
		<path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
	</svg>
</a>
@endif
