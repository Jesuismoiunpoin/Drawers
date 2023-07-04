<?php

namespace Drawer;

use Drawer\Events\DrawerPlace;
use Drawer\Events\DrawerBreak;
use Drawer\Events\DrawerPut;
use Drawer\Events\DrawerInteract;
use Drawer\API\DrawerAPI;
use Drawer\Forms\DrawerForm;
use pocketmine\plugin\PLuginBase;
use pocketmine\event\Listener;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener
{
    private static $instance;

    private Config $config;

    public function onEnable(): void
    {
        @mkdir($this->getDataFolder()."blocks/");
        @mkdir($this->getDataFolder());
        $this->saveResource("setting.yml");
        $this->saveDefaultConfig();
        self::$instance = $this;
        $this->config = new Config($this->getDataFolder()."setting.yml",Config::YAML);
        $this->getServer()->getPluginManager()->registerEvents(new DrawerAPI(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new DrawerForm(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new DrawerPlace(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new DrawerBreak(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new DrawerPut(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new DrawerInteract(), $this);
    }

    public static function getInstance(): Main{
        return self::$instance;
    }

    public function getConfig(): Config
    {
        return $this->config;
    }
}