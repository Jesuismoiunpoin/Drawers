<?php

namespace Drawer\Events;

use Drawer\Main;
use Drawer\API\DrawerAPI;
use pocketmine\event\block\BlockPlaceEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\utils\Config;

class DrawerPlace implements Listener
{
    public function onPlace(BlockPlaceEvent $event)
    {
        $block = $event->getBlock();
        $sttg = Main::getInstance()->getConfig();
        $x = $block->getPosition()->getX();
        $y = $block->getPosition()->getY();
        $z = $block->getPosition()->getZ();
        if($block->getId() == $sttg->get("id") && $block->getMeta() == $sttg->get("meta")){
        DrawerAPI::addDrawer($x, $y, $z);
        }
    }
}