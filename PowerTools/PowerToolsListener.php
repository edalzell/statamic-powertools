<?php

namespace Statamic\Addons\PowerTools;

use Statamic\API\Nav;
use Statamic\API\User;
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
        'cp.nav.created'  => 'nav',
    ];

    /**
     * Initialize Aggregator assets
     * @return string css link
     */
    public function powerUp()
    {
        $html = $this->js->tag('powertools');
        $html .= $this->css->tag('powertools');
        return $html;
    }

    /**
     * Add PHP Info to the side nav
     * @param  Nav    $nav [description]
     * @return void
     */
    public function nav($nav)
    {
        // Only super users can see the PHP info
        /** @var \Statamic\Data\Users\User $user */
        $user = User::getCurrent();
        if ($user && $user->isSuper())
        {
            $nav->addTo(
                'tools',
                Nav::item('PHP Info')->route('phpinfo')->icon('info'));
            $nav->addTo(
                'tools',
                Nav::item('Logs')->route('logs')->icon('book'));
        }
    }
}
