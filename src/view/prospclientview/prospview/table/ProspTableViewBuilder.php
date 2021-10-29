<?php

namespace MVCExo\view\prospclientview\prospview\table;

use MVCExo\Autoloader;

Autoloader::register();

class ProspTableViewBuilder extends ProspTableAssemblyLine
{
    public function buildOrder(array $prospTableData)
    {
        $this->pageContent = file_get_contents('public/html/head.html');
        $this->pageContent .= file_get_contents('public/html/nav.html');

        $pageSettingsList = $this->pageSettingsListStorage('client');
        $this->pageSetup($pageSettingsList);

        $this->pageContent .= file_get_contents('public/html/prospclient/table/prospclienttabletop.html');  // inclusion du haut du tableau des prospects/clients
        $rowsArray = $this->tableRowsBuilder('prospect', $prospTableData);

        foreach ($rowsArray as $value) {
            $this->pageContent .= $value;
        }

        $this->pageContent .= file_get_contents('public/html/prospclient/table/prospclienttablebottom.html'); // inclusion du bas du tableau des prospects/clients
        $this->tableSetup($this->tableSettingsList);
        $this->pageContent .= file_get_contents('public/html/footer.html');
        $this->pageDisplay();
    }
}
