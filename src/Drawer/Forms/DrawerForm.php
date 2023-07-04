<?php

namespace Drawer\Forms;

use Drawer\Main;
use Drawer\API\DrawerAPI;
use pocketmine\event\Listener;
use pocketmine\player\Player;
use pocketmine\utils\Config;
use pocketmine\item\ItemFactory;
use jojoe77777\FormAPI\CustomForm;

class DrawerForm implements Listener
{
    public static function drawerUI(Player $player, $x, $y, $z){
        $sttg = Main::getInstance()->getConfig();
        $cfg = new Config(Main::getInstance()->getDataFolder()."blocks/drawer.yml", Config::YAML);
        $form = new CustomForm(function (Player $player, array $data = null) use($sttg, $x, $y, $z, $cfg){
            if(is_null($data)){
                return true;
            }
            DrawerAPI::removeItem($x, $y, $z, $data[1]);
            $player->getInventory()->addItem(ItemFactory::getInstance()->get($cfg->get("drawer-{$x}.{$y}.{$z}")['id'], $cfg->get("drawer-{$x}.{$y}.{$z}")['meta'], $data[1]));
            return false;
        });
        $form->setTitle($sttg->get("title"));
        $form->addLabel($sttg->get("content"));
        $form->addSlider($cfg->get("drawer-{$x}.{$y}.{$z}")['name'], 1, $cfg->get("count-{$x}.{$y}.{$z}"), 1, -1);
        $player->sendForm($form);
    }
}