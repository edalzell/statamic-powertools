<div id="searchmanager" class="card">
    <div class="card-header">
        <h2><em class="icon icon-magnifying-glass"></em> Search Manager</h2>
        <div class="btn-group pull-right">
            <button type="button" class="btn-more dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="icon icon-dots-three-vertical"></i>
            </button>
            <ul class="dropdown-menu">
                <li><a href="/{{ $cp_path }}/settings/cp"><span class="icon icon-browser" aria-hidden="true"></span> Widget Settings</a></li>
                <li><a href="{{ $github_page }}" target="_blank"><span class="icon icon-github" aria-hidden="true"></span> Github Page</a></li>
            </ul>
        </div>
    </div>

    <div class="card-body">
        <div>
            <a href="/{{ $cp_path }}/addons/searchmanager/rebuild-search" class="btn btn-primary"><em class="icon icon-ccw"></em> Rebuild Search Index</a>
        </div>
    </div>
</div>
