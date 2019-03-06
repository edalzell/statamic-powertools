<div id="powertools" class="card flush">
    <div class="head">
        <h1>PowerTools</h1>
        <div class="btn-group pull-right">
            <a href="{{ route('logs') }}" class="btn"><span class="icon icon-book"></span> &nbsp; Logs</a>
            <a href="{{ route('phpinfo') }}" class="btn"><span class="icon icon-info"></span> &nbsp; PHP Info</a>
            <button type="button" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
      <div class="form-group text-fieldtype width-100">
        <div class="field-inner">
            <label class="block">Search</label>
            <div class="btn-group">
                <a href="{{ route('powertools.rebuild-search') }}" class="btn lock">Update Search Indexes</a>
            </div>
        </div>
      </div>
      <div class="form-group text-fieldtype width-100">
        <div class="field-inner">
	    <label class="block">Caching</label>
            <div class="btn-group">
                <a href="{{ route('powertools.clear-cache') }}" class="btn lock">Clear Cache</a>
                <a href="{{ route('powertools.update-stache') }}" class="btn lock">Clear Stache</a>
                <a href="{{ route('powertools.clear-static') }}" class="btn lock">Clear Static</a>
                <a href="{{ route('powertools.clear-glide') }}" class="btn lock">Clear Glide</a>
            </div>
        </div>
      </div>
      @unless (isset($settings['hide_presets']) && $settings['hide_presets'])
        <div class="form-group text-fieldtype width-100">
            <div class="field-inner">
                <label class="block">Image Manipulation Presets</label>
                <div class="btn-group">
                    <a href="{{ route('powertools.assets-generate-presets') }}" class="btn lock">Generate Assets</a>
                    <a href="{{ route('powertools.assets-regenerate-presets') }}" class="btn lock">Regenerate Assets</a>
                </div>
            </div>
        </div>
      @endunless
    </div>
</div>