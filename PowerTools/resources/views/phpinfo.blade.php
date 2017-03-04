@extends('layout')

<style>
	.center > table {
		background-color: #fff;
		border-radius: 3px;
		box-shadow: 0 1px 3px rgba(0,0,0,.25);
	}
	.center > table td,
	.center > table th {
		padding: 15px;
	}
	.center > table th {
		font-size: 20px;
	}
	.h a,
	.v a {
		display: inline-block;
		float: left;
		margin-right: 30px;
	}
	.e {
		vertical-align: top;
	}
	.v {
		max-width: 300px;
		word-wrap: break-word;
	}
</style>

@section('content')
	{!! $html !!}
@stop
