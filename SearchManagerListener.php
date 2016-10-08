<?php

namespace Statamic\Addons\SearchManager;

use Statamic\Extend\Listener;

class SearchManagerListener extends Listener
{
    /**
     * The events to be listened for, and the methods to call.
     *
     * @var array
     */
    public $events = [
        'cp.add_to_head'  => 'initSearchManager',
    ];


    /**
     * Initialize Aggregator assets
     * @return [type] [description]
     */
    public function initSearchManager()
    {
        $addon_css = $this->css->url('searchmanager.css');
        $html = '<link rel="stylesheet" href="' . $addon_css . '">';
        return $html;
    }
}
