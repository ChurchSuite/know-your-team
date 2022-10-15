@props([
	'action' => '',
	'method' => 'post',
])
<form
	action="{{ $action }}"
	class="space-y-4"
	method="{{ $method }}"
	x-data="{
		formData: [],
		errors: [],
		formSubmit() {
			let fetchData = new FormData($el)

			fetch($el.action, {
				body: fetchData,
				method: $el.method
			}).then(function (response) {
				if (response.ok) {
					return response.json();
				}
				return Promise.reject(response);
			}).then(function (data) {
				console.log(data);
			}).catch(function (error) {
				console.warn('Something went wrong.', error);
			});
		}
	}"
>
	@csrf
	{{ $slot }}
</form>