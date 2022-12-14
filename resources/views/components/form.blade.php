@props([
	'action' => '',
	'formData' => '[]',
	'method' => 'post',
])

<form
	action="{{ $action }}"
	class="space-y-4"
	method="{{ $method == 'put' ? 'post' : $method }}"
	x-data="{
		formData: {{ htmlspecialchars_decode($formData) }},
		formErrors: [],
		formSubmit() {
			let self = this
			let fetchData = new FormData($el)
			{{ $method == 'put' ? 'fetchData.append(\'_method\', \'put\')' : '' }}

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
				{{ $method == 'put' ? 'return response.ok === true ? response : response.json()' : 'return response.json()' }}
			}).then(function (data) {
console.log(data)
				if (Object.keys(data).includes('errors')) {
					self.formErrors = data.errors
				} else {
					// do stuff
					if (Object.keys(data).includes('redirect')) {
						location.href = data.redirect
					} else {
						location.reload()
					}
				}
			}).catch(function (error) {
				console.warn('thrown?', error)
			})
		}
	}"
>
	@csrf
	{{ $slot }}
</form>