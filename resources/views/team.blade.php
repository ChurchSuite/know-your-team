@extends('layout')

@section('content')
	New Team Form
	<x-form>
		<x-field-text></x-field-text>
		<x-field-select>
			<x-field-select-option value="option_1">
				Option 1
			</x-field-select-option>
		</x-field-select>
		<x-button-submit>Submit</x-button-submit>
	</x-form>
@stop