@extends('layout')

@section('content')

<div x-init="fetch('/api/data?test_identifier={{ $test_identifier }}').then(res => res.json()).then(data => console.log(data))"></div>

<x-page-section>
</x-page-section>
@stop