<?php

namespace Statamic\Addons\SearchManager;

use Illuminate\Support\Facades\Artisan;
use Statamic\Extend\Controller;
use Log;

class SearchManagerController extends Controller
{
    /**
     * Rebuild the search index
     * @return void
     */
    public function rebuildSearchIndex()
    {

        try {
            $exitCode = Artisan::call('search:update');

            return back()->with('success', 'Search index rebuilt successfully');
        } catch (Exception $e) {
            Log::error('Problem rebuilding your search index');
            return back()->withErrors('error', ' Problem rebuilding your search index' . $e);
        }
    }
}
