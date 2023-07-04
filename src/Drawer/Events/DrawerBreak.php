<?php

namespace Drawer\Events;

use Drawer\Main;
use Drawer\API\DrawerAPI;
use pocketmine\event\block\BlockBreakEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\utils\Config;
use pocketmine\item\ItemFactory;

class DrawerBreak implements Listener
{
    public function onBreak(BlockBreakEvent $event)
    {
        $block = $event->getBlock();
        $sttg = Main::getInstance()->getConfig();
        $x = $block->getPosition()->getX();
        $y = $block->getPosition()->getY();
        $z = $block->getPosition()->getZ();
        $cfg = new Config(Main::getInstance()->getDataFolder()."blocks/drawer.yml", Config::YAML);
        if($block->getId() == $sttg->get("id") && $block->getMeta() == $sttg->get("meta")){
        DrawerAPI::removeDrawer($x, $y, $z);
        $block->getPosition()->getWorld()->dropItem($block->getPosition(), ItemFactory::getInstance()->get($cfg->get("drawer-{$x}.{$y}.{$z}")['id'], $cfg->get("drawer-{$x}.{$y}.{$z}")['meta'], $cfg->get("count-{$x}.{$y}.{$z}")));
        }
    }
}