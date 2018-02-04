<div id="powertools" class="card flush">
    <div class="head">
        <h1>PowerTools</h1>
        <div class="btn-group pull-right">
            <a href="{{ route('logs') }}" class="btn btn-primary"><span class="icon icon-book"></span> &nbsp; Logs</a>
            <a href="{{ route('phpinfo') }}" class="btn btn-primary"><span class="icon icon-info"></span> &nbsp; PHP Info</a>
            <button type="button" class="btn btn-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="{{ route('settings.edit', 'cp') }}"><span class="icon icon-browser" aria-hidden="true"></span> Widget Settings</a></li>
                <li><a href="{{ route('addon.settings', 'PowerTools') }}"><span class="icon icon-power-plug" aria-hidden="true"></span> Addon Settings</a></li>
                <li><a href="{{ $github_page }}" target="_blank"><span class="icon icon-github" aria-hidden="true"></span> Github Page</a></li>
            </ul>
        </div>
    </div>

    <div class="card-body pad-16">
        <h2>Search</h2><br />
        <a href="{{ route('powertools.rebuild-search') }}" class="btn">Rebuild Index</a>
    </div>

    <div class="card-body pad-16">
        <h2>Cache</h2><br />
        <div class="btn-group">
            <a href="{{ route('powertools.update-stache') }}" class="btn">Update Stache</a>
            <a href="{{ route('powertools.clear-cache') }}" class="btn">Clear Cache</a>
            <a href="{{ route('powertools.clear-static') }}" class="btn">Clear Static Cache</a>
        </div>
    </div>

    <div class="card-body pad-16">
        <h2>Glide Assets</h2><br />
        <div class="btn-group">
            <a href="{{ route('powertools.assets-generate-presets') }}" class="btn">Generate Presets</a>
            <a href="{{ route('powertools.assets-regenerate-presets') }}" class="btn">Regenerate Presets</a>
        </div>
    </div>
</div>