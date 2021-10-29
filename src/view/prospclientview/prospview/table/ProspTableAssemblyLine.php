<?php

namespace MVCExo\view\prospclientview\prospview\table;

use MVCExo\Autoloader;

Autoloader::register();

abstract class ProspTableAssemblyLine extends \MVCExo\view\prospclientview\prospview\ProspPageAssemblyLine
{
    protected array $tableSettingsList;

    public function __construct()
    {
        $this->tableSettingsList = array(
            "tableTitle" => "Liste des prospects",
            "addLink" => "index.php?controller=prospect&action=add",
            "addLinkText" => "Ajouter un prospect"
        );
    }
}
