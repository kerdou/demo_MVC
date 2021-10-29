<?php

namespace MVCExo\view\catview\table;

use MVCExo\Autoloader;

Autoloader::register();

abstract class CatTableAssemblyLine extends \MVCExo\view\catview\CatPageAssemblyLine
{
    protected array $tableSettingsList;

    public function __construct()
    {
        $this->tableSettingsList = array(
            "tableTitle" => "Liste des catégories",
            "addLink" => "index.php?controller=category&action=add",
            "addLinkText" => "Ajouter une catégorie"
        );
    }

    protected function tableRowsBuilder(array $tableData)
    {
        $rowsArray = \MVCExo\view\TableBuilder::categoryTableRowWithButtonsBuilder($tableData);
        return $rowsArray;
    }
}
