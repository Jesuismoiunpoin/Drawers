<?php

namespace Drawer\API;

use Drawer\Main;
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\world\Position;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;
use pocketmine\item\ItemFactory;

class DrawerAPI implements Listener{

    public static function addDrawer($x, $y, $z)
    {
        $config = new Config(Main::getInstance()->getDataFolder()."blocks/drawer.yml", Config::YAML);
        $config->set("count-{$x}.{$y}.{$z}", 0);
        $config->set("drawer-{$x}.{$y}.{$z}", ["name" => "None", "id" => 0, "meta" => 0]);
        $config->save();
    }

    public static function removeDrawer($x, $y, $z)
    {
        $config = new Config(Main::getInstance()->getDataFolder()."blocks/drawer.yml", Config::YAML);
        $config->remove("count-{$x}.{$y}.{$z}");
        $config->remove("drawer-{$x}.{$y}.{$z}");
        $config->save();
    }

    public static function setItem($x, $y, $z, $name, $id, $meta)
    {
        $config = new Config(Main::getInstance()->getDataFolder()."blocks/drawer.yml", Config::YAML);
        $config->set("count-{$x}.{$y}.{$z}", $config->get("count-{$x}.{$y}.{$z}") + 1);
        $config->set("drawer-{$x}.{$y}.{$z}", ["name" => "{$name}", "id" => $id, "meta" => $meta]);
        $config->save();
    }

    public static function removeItem($x, $y, $z, $amount)
    {
        $config = new Config(Main::getInstance()->getDataFolder()."blocks/drawer.yml", Config::YAML);
        $config->set("count-{$x}.{$y}.{$z}", $config->get("count-{$x}.{$y}.{$z}") - $amount);
        $config->save();
    }
}