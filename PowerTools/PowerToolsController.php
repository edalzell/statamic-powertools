<?php

namespace Statamic\Addons\PowerTools;

use Log;
use Statamic\API\User;
use Statamic\API\Cache;
use Statamic\API\Search;
use Statamic\API\Stache;
use Statamic\Extend\Controller;
use Illuminate\Support\Facades\Artisan;

class PowerToolsController extends Controller
{
    /**
     * Returns the PHP Info
     *
     * @return string
     */
    private function getPHPInfo()
    {
        ob_start();
        phpInfo();
        $html = ob_get_contents();
        ob_end_clean();
         
        $html = preg_replace( '%^.*<body>(.*)</body>.*$%ms','$1',$html);

        return $html;
    }
    
    public function phpinfo()
    {
        $this->authorize('super');

        return $this->view('phpinfo', ['html' => $this->getPHPInfo()]);
    }

    /**
     * Rebuild the search index
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rebuildSearchIndex()
    {
        return $this->doThing(
            function() { Search::update(); },
            'Search index rebuilt successfully',
            'Problem rebuilding your search index'
        );
    }

    /**
     * Update Stache cache
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStache()
    {
        return $this->doThing(
            function() { Stache::update(); },
            'Stache updated successfully',
            'Problem updating your stache'
        );
    }

    /**
     * Clear Statamic cache
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearCache()
    {
        return $this->doThing(
            function() { Cache::clear(); },
            'Cache cleared successfully',
            'Problem clearing your cache'
        );
    }

    /**
     * Clear static page cache
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearStaticCache()
    {
        return $this->doThing(
            function() { Artisan::call('clear:static'); },
            'Static page cache cleared successfully',
            'Problem clearing your static page cache'
        );
    }

    /**
     * Show the PHP info
     */
    //public function php

    /**
     * @param callable $func
     * @param string $success
     * @param string $error
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    private function doThing($func, $success, $error)
    {
        $this->authorize('cp:access');

        try
        {
            $func();
            return back()->with('success', $success);
        } catch (\Exception $e) {
            Log::error($error);
            return back()->withErrors('error', $error . $e);
        }
    }

    // /**
    //  * Clear Pagespeed cache
    //  * @return void
    //  */
    // public function clearPageSpeed()
    // {

    //     try {
    //         // Update feed
    //         $this->cachemanager->clearPageSpeed();

    //         // Log success returns
    //         Log::info('Pagespeed cache cleared successfully');

    //         // Return back to dashboard with success message
    //         return back()->with('success', 'Pagespeed cache cleared successfully');
    //     } catch (Exception $e) {
    //         Log::error('Problem clearing your Pagespeed cache');
    //         return back()->withErrors('error', ' Problem clearing your Pagespeed cache' . $e);
    //     }
    // }


    // /**
    //  * Clear PHP OpCache cache
    //  * @return void
    //  */
    // public function clearOpCache()
    // {

    //     try {
    //         // Update feed
    //         $this->cachemanager->clearOpCache();

    //         // Log success returns
    //         Log::info('OPCache cleared successfully');

    //         // Return back to dashboard with success message
    //         return back()->with('success', 'OPCache cache cleared successfully');
    //     } catch (Exception $e) {
    //         Log::error('Problem clearing your OPCache cache');
    //         return back()->withErrors('error', ' Problem clearing your OPCache cache' . $e);
    //     }
    // }
}
