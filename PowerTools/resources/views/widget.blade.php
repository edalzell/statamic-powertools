<div id="powertools" class="card">
    <div class="card-header">
        <h2>Search</h2>
        <div class="btn-group pull-right">
            <button type="button" class="btn-more dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="icon icon-dots-three-vertical"></i>
            </button>
            <ul class="dropdown-menu">
                <li><a href="{{ route('settings.edit', 'cp') }}"><span class="icon icon-browser" aria-hidden="true"></span> Widget Settings</a></li>
                <li><a href="{{ route('addon.settings', 'PowerTools') }}"><span class="icon icon-power-plug" aria-hidden="true"></span> Addon Settings</a></li>
                <li><a href="{{ $github_page }}" target="_blank"><span class="icon icon-github" aria-hidden="true"></span> Github Page</a></li>
            </ul>
        </div>
    </div>

    <div class="card-body padding-bottom">
        <div>
            <a href="{{ route('powertools.rebuild-search') }}" class="btn">Rebuild Index</a>
        </div>
    </div>

    <div class="card-header padding-top">
        <h2>Cache</h2>
    </div>

    <div class="card-body padding-bottom">
        <div class="btn-group">
            <a href="{{ route('powertools.update-stache') }}" class="btn">Update Stache</a>
        </div>
        <div class="btn-group">
            <a href="{{ route('powertools.clear-cache') }}" class="btn">Clear Cache</a>
        </div>
        <div class="btn-group">
            <a href="{{ route('powertools.clear-static') }}" class="btn">Clear Static Cache</a>
        </div>
    </div>

    <div class="card-header padding-top">
        <h2>Glide Assets</h2>
    </div>

    <div class="card-body padding-bottom">
        <div class="btn-group">
            <a href="{{ route('powertools.assets-generate-presets') }}" class="btn">Generate Presets</a>
        </div>
        <div class="btn-group">
            <a href="{{ route('powertools.assets-regenerate-presets') }}" class="btn">Regenerate Presets</a>
        </div>
    </div>
</div>