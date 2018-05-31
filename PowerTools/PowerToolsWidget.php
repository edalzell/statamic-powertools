<?php

namespace Statamic\Addons\PowerTools;

use Statamic\Extend\Widget;

class PowerToolsWidget extends Widget
{

    /**
     * The HTML that should be shown in the widget
     *
     * @return string
     */
    public function html()
    {
        // Get settings
        $settings    = $this->getConfig();
        $hide_presets = $this->getConfig('hide_presets');
        $github_page = $this->getMeta()['url'];
        return $this->view('widget', compact('settings', 'hide_presets', 'github_page'))->render();
    }
}
