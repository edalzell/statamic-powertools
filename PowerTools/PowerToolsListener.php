<?php

namespace Statamic\Addons\PowerTools;

use Statamic\Extend\Listener;
use Statamic\CP\Navigation\Nav;
use Statamic\CP\Navigation\NavItem;

class PowerToolsListener extends Listener
{
    /**
     * The events to be listened for, and the methods to call.
     *
     * @var array
     */
    public $events = [
        'cp.add_to_head'  => 'powerUp',
        'cp.nav.created'  => 'nav',
    ];

    /**
     * Initialize Aggregator assets
     * @return string css link
     */
    public function powerUp()
    {
        return '<link rel="stylesheet" href="' . $this->css->url('powertools.css') . '">';
    }

    /**
     * Add PHP Info to the side nav
     * @param  Nav    $nav [description]
     * @return void
     */
    public function nav(Nav $nav)
    {
        $nav->addTo(
            'tools',
            (new NavItem)->name('PHP Info')->route('phpinfo')->icon('info'));
    }
}
