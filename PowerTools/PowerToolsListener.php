<?php

namespace Statamic\Addons\PowerTools;

use Statamic\Extend\Listener;

class PowerToolsListener extends Listener
{
    /**
     * The events to be listened for, and the methods to call.
     *
     * @var array
     */
    public $events = [
        'cp.add_to_head'  => 'powerUp',
    ];

    /**
     * Initialize Aggregator assets
     * @return string css link
     */
    public function powerUp()
    {
        return '<link rel="stylesheet" href="' . $this->css->url('powertools.css') . '">';
    }
}
