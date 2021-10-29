<?php

namespace MVCExo\view\catview\table;

use MVCExo\Autoloader;

Autoloader::register();

class CatTableViewBuilder extends CatTableAssemblyLine
{
    public function buildOrder(array $catTableData)
    {
        $this->pageContent = file_get_contents('public/html/head.html');
        $this->pageContent .= file_get_contents('public/html/nav.html');

        $pageSettingsList = $this->pageSettingsListStorage();
        $this->pageSetup($pageSettingsList);

        $this->pageContent .= file_get_contents('public/html/category/table/cattabletop.html'); // inclusion du haut du tableau des catégories

        $rowsArray = $this->tableRowsBuilder($catTableData);

        foreach ($rowsArray as $value) {
            $this->pageContent .= $value;
        }

        $this->pageContent .= file_get_contents('public/html/category/table/cattablebottom.html'); // inclusion du bas du tableau des catégories
        $this->tableSetup($this->tableSettingsList);
        $this->pageContent .= file_get_contents('public/html/footer.html');
        $this->pageDisplay();
    }
}
