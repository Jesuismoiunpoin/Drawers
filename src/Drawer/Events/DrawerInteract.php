<?php

namespace Drawer\Events;

use Drawer\Main;
use Drawer\API\DrawerAPI;
use Drawer\Forms\DrawerForm;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\utils\Config;

class DrawerInteract implements Listener
{
    public function onInteract(PlayerInteractEvent $event)
    {
        $block = $event->getBlock();
        $player = $event->getPLayer();
        $sttg = Main::getInstance()->getConfig();
        $x = $block->getPosition()->getX();
        $y = $block->getPosition()->getY();
        $z = $block->getPosition()->getZ();
        if($block->getId() == $sttg->get("id") && $block->getMeta() == $sttg->get("meta")){
            if(!$player->isSneaking()){
            DrawerForm::drawerUI($player, $x, $y, $z);
            }
        }
    }
}