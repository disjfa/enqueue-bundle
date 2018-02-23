<?php

namespace Disjfa\EnqueueBundle\Menu\Admin;

use App\Menu\ConfigureMenuEvent;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

class EnqueueMenuListener
{
    /**
     * @param ConfigureMenuEvent $event
     */
    public function onMenuConfigure(ConfigureMenuEvent $event)
    {
        try {
            $menu = $event->getMenu();
            $menu->addChild('enqueue', [
                'label' => 'Enqueue',
                'route' => 'admin_enqueue_index',
            ])->setExtra('icon', 'fa-tachometer-alt');
        } catch (RouteNotFoundException $e) {
            // routing.yml not set up
            return;
        }
    }
}