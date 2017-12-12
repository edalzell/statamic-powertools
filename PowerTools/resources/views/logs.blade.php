@extends('layout')

@section('content')
<div id="logbook">

    <div class="card sticky flat-bottom">
        <div class="head">
            <h1>Logbook</h1>
        </div>
    </div>

    @if (count($files))
        <div class="card flat-top flat-bottom">
            <form class="log-picker" method="GET" action="{{ $action_path }}">
                <div class="select" data-content="@if($current_file) {{ $current_file }} @endif">
                    <select name="log">
                        @foreach($files as $file)
                            <option value="{{ base64_encode($file) }}" @if ($file == $current_file) selected @endif>{{ $file }}</option>
                        @endforeach
                    </select>
                </div>
            </form>

            @if ($current_file)
                <div class="pull-right">
                    @if (count($logs))
                        <a id="download-log" class="btn btn-primary" href="?dl={{ base64_encode($current_file) }}">Download file</a>
                    @endif

                    @if (count($files) > 1)
                        <div class="btn-group">
                            <a id="delete-log" class="btn btn-danger" href="?del={{ base64_encode($current_file) }}">Delete file</a>
                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a id="delete-all-log" href="?delall=true">Delete all files</a></li>
                            </ul>
                        </div>
                    @else
                        <a id="delete-log" class="btn btn-danger" href="?del={{ base64_encode($current_file) }}">Delete file</a>
                    @endif
                </div>
            @endif
        </div>
    @endif

    <div class="card flat-top">
        @if (count($logs) === 0)
            Log file is empty.
        @elseif ($logs === null)
            Log file >50M, please download it.
        @else
            <table class="dossier">
                <thead>
                    <tr>
                        <th>Level</th>
                        <th>Context</th>
                        <th>Date</th>
                        <th>Content</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($logs as $key => $log)
                        <tr class="@if ($log['stack']) expandable @endif" data-display="stack{{{$key}}}">
                            <td class="level">
                                <span class="level-icon icon-{{{ $log['level_img'] }}}" aria-hidden="true"></span>
                                &nbsp;{{ $log['level'] }}
                            </td>
                            <td class="context">
                                {{ $log['context'] }}
                            </td>
                            <td class="date">
                                {{{ $log['date'] }}}
                            </td>
                            <td class="text">                                
                                {{{ $log['text'] }}}
                                
                                @if (isset($log['in_file'])) <br>{{{ $log['in_file'] }}} @endif

                                @if ($log['stack'])
                                    <div id="stack{{{ $key }}}" class="stack-trace" style="display: none;">{{{ trim($log['stack']) }}}</div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</div>    
@endsection
