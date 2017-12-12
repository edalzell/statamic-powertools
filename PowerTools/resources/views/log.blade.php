@extends('layout')

@section('content')
    <div class="card">
        <div class="card-body">
            <pre>
                <code>
                    {!! $html !!}
                </code>
            </pre>
        </div>
    </div>
  </div>
@stop
