<?php

namespace Statamic\Addons\PowerTools;

use Log;
use Statamic\API\Path;
use Statamic\API\Cache;
use Statamic\API\Search;
use Statamic\API\Stache;
use Statamic\Extend\Controller;
use Illuminate\Support\Facades\Artisan;
use Rap2hpoutre\LaravelLogViewer\LaravelLogViewer;


class PowerToolsController extends Controller
{
    public function phpinfo()
    {
        $this->authorize('super');

        return $this->view('phpinfo', ['html' => $this->getPHPInfo()]);
    }


    public function logs()
    {
        if (! auth()->check()) {
            return redirect('/');
        }
        
        $logviewer = new LaravelLogViewer;

        if ($file = request('log')) {
            $logviewer->setFile(base64_decode($file));
        }
        
        if ($file = request('dl')) {
            return response()->download($logviewer->pathToLogFile(base64_decode($file)));
        }
        
        if ($file = request('del')) {
            app('files')->delete($logviewer->pathToLogFile(base64_decode($file)));
            return redirect(request()->url());
        }
        
        if (request()->has('delall')) {
            foreach ($logviewer->getFiles(true) as $file) {
                app('files')->delete($logviewer->pathToLogFile($file));
            }
            return redirect(request()->url());
        }

        $data = [
            'logs' => $logviewer->all(),
            'files' => $logviewer->getFiles(true),
            'current_file' => $logviewer->getFileName(),
            'action_path' => route('logs'),
        ];

        return $this->view('logs', $data);
    }

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
     * Clear Glide image cache
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clearGlide()
    {
        return $this->doThing(
            function() { Artisan::call('clear:glide'); },
            'Glide image cache cleared successfully',
            'Problem clear your Glide image cache'
        );
    }


    /**
     * Generate Asset Presets
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generatePresets()
    {
        return $this->doThing(
            function() { $this->generatePresetsInBackground(); },
            'Glide asset generated successfully',
            'Problem generating your glide assets'
        );
    }

    /**
     * Regenerate Asset Presets
     * @return \Illuminate\Http\RedirectResponse
     */
    public function regeneratePresets()
    {
        return $this->doThing(
            function() {
              Artisan::call('clear:glide');
              $this->generatePresetsInBackground();
            },
            'Glide asset regenerated successfully',
            'Problem regenerating your glide assets'
        );
    }

    /**
     * Generate Asset Presets (via cli to avoid timeouts)
     * @return \Illuminate\Http\RedirectResponse
     */
    private function generatePresetsInBackground()
    {
        $please_script = escapeshellarg(Path::makeFull('/') . 'please');
        putenv('SHELL=' . $this->getConfig('shell_path', '/bin/bash'));
        shell_exec($this->getConfig('php_path', PHP_BINDIR . '/php') . ' ' . $please_script . ' assets:generate-presets | at now 2>&1');
    }

    protected function highlight($line)
    {
        // modify the string to have some fancy bits
        return $line;
    }

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
