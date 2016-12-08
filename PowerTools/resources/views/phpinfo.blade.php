@extends('layout')

@section('content')
<iframe src="data:text/html,{{ $html }}" style="width: 100%; height: calc(100vh - 150px); border: 0;"></iframe>
@stop
