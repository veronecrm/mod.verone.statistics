<?php
/**
 * Verone CRM | http://www.veronecrm.com
 *
 * @copyright  Copyright (C) 2015 - 2016 Adam Banaszkiewicz
 * @license    GNU General Public License version 3; see license.txt
 */

namespace App\Module\Statistics\Controller;

use CRM\App\Controller\BaseController;

/**
 * @section mod.Statistics.Statistics
 */
class Statistics extends BaseController
{
    /**
     * @access core.read
     */
    public function indexAction($request)
    {
        $tabs = [];
        $base = [
            'ordering'  => 0,
            'icon'      => 'fa fa-asterisk',
            'icon-type' => 'class',
            'name'      => 'EMPTY',
            'tab'       => 'tab-empty',
            'module'    => 'NONE'
        ];

        foreach($this->callPlugins('Statistics', 'tabs') as $module)
        {
            foreach($module as $link)
            {
                $tabs[] = array_merge($base, $link);
            }
        }

        array_multisort($tabs, SORT_REGULAR);

        $module = $tabs[0]['module'];
        $tab    = $tabs[0]['tab'];

        if($request->query->has('tab'))
            $tab = $request->query->get('tab');
        if($request->query->has('module'))
            $module = $request->query->get('module');


        return $this->render('index', [
            'tabs' => $tabs
        ]);
    }

    /**
     * @access core.read
     */
    public function showAction($request)
    {
        if($request->query->has('tab'))
            $tab = $request->query->get('tab');
        else
            return $this->redirect('Statistics', 'Statistics');

        if($request->query->has('module'))
            $module = $request->query->get('module');
        else
            return $this->redirect('Statistics', 'Statistics');


        return $this->render('show', [
            'content' => $this->get('package.plugin.manager')->callPlugin($module, 'Statistics', 'contents', [ $tab ])
        ]);
    }
}
