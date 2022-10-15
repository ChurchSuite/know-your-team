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
		formErrors: [],
		formSubmit() {
			let self = this
			let fetchData = new FormData($el)

			{{-- clear errors --}}
			self.formErrors = []

			{{-- post the form --}}
			fetch($el.action, {
				body: fetchData,
				method: $el.method,
				headers: {
					'Accept': 'application/json',
				}
			}).then(function (response) {
				return response.json()
			}).then(function (data) {
				if (Object.keys(data).includes('errors')) {
					self.formErrors = data.errors
				} else {
					// do stuff
					console.log(data)
				}
			}).catch(function (error) {
				console.warn(error)
			})
		}
	}"
>
	@csrf
	{{ $slot }}
</form>