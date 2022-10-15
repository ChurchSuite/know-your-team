<form
	action=""
	x-data="{
		formData: [],
		errors: [],
		formSubmit() {
			console.log(new FormData($el))
		}
	}"
	method=""
>
	@csrf
	{{ $slot }}
</form>