@props([
	'action' => '',
	'formData' => '[]',
	'method' => 'post',
])

<form
	action="{{ $action }}"
	class="space-y-4"
	method="{{ $method }}"
	x-data="{
		formData: {{ htmlspecialchars_decode($formData) }},
		formErrors: [],
		formSubmit() {
			let self = this
			let fetchData = new FormData($el)
			let method = $el.method
			if (method == 'put') {
				fetchData.append('_method', method)
				method = 'post'
			}

			{{-- clear errors --}}
			self.formErrors = []

			{{-- post the form --}}
			fetch($el.action, {
				body: fetchData,
				method: method,
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