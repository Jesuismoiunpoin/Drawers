<?php

namespace Drawer\Events;

use Drawer\Main;
use Drawer\API\DrawerAPI;
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\utils\Config;
use pocketmine\item\ItemFactory;

class DrawerPut implements Listener
{
    public function onInteract(PlayerInteractEvent $event)
    {
        $block = $event->getBlock();
        $player = $event->getPLayer();
        $sttg = Main::getInstance()->getConfig();
        $x = $block->getPosition()->getX();
        $y = $block->getPosition()->getY();
        $z = $block->getPosition()->getZ();
        $hand = $player->getInventory()->getItemInHand();
        $id = $hand->getId();
        $meta = $hand->getMeta();
        $name = $hand->getName();
        $cfg = new Config(Main::getInstance()->getDataFolder()."blocks/drawer.yml", Config::YAML);
        if($block->getId() == $sttg->get("id") && $block->getMeta() == $sttg->get("meta")){
            if($player->isSneaking()){
                if($cfg->get("count-{$x}.{$y}.{$z}") >= 1){
                    if($hand->getName() == $cfg->get("drawer-{$x}.{$y}.{$z}")['name']){
                    $player->getInventory()->removeItem(ItemFactory::getInstance()->get($id, $meta, 1));
                    DrawerAPI::setItem($x, $y, $z, $name, $id, $meta);
                    }
                }
                if($cfg->get("count-{$x}.{$y}.{$z}") == 0){
                DrawerAPI::setItem($x, $y, $z, $name, $id, $meta);
                $player->getInventory()->removeItem(ItemFactory::getInstance()->get($id, $meta, 1));
                }
            }
        }
    }
}