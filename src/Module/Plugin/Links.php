<?php
/**
 * Verone CRM | http://www.veronecrm.com
 *
 * @copyright  Copyright (C) 2015 - 2016 Adam Banaszkiewicz
 * @license    GNU General Public License version 3; see license.txt
 */

namespace App\Module\Statistics\Plugin;

use CRM\App\Module\Plugin;

class Links extends Plugin
{
    public function dashboard()
    {
        if($this->acl('mod.Statistics.Statistics', 'mod.Statistics')->isAllowed('core.read'))
        {
            return [
                [
                    'ordering' => 100,
                    'icon' => 'fa fa-bar-chart-o',
                    'icon-type' => 'class',
                    'name' => $this->t('statistics'),
                    'href' => $this->createUrl('Statistics', 'Statistics')
                ]
            ];
        }
    }
}
