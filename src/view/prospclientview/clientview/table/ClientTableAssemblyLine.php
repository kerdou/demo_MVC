<?php

namespace MVCExo\view\prospclientview\clientview\table;

use MVCExo\Autoloader;

Autoloader::register();

abstract class ClientTableAssemblyLine extends \MVCExo\view\prospclientview\clientview\ClientPageAssemblyLine
{
    protected array $tableSettingsList;

    public function __construct()
    {
        $this->tableSettingsList = array(
            "tableTitle" => "Liste des clients",
            "addLink" => "index.php?controller=client&action=add",
            "addLinkText" => "Ajouter un client"
        );
    }
}
