<?php

namespace MVCExo\view\homeview;

use MVCExo\Autoloader;

Autoloader::register();


class HomeViewBuilder extends \MVCExo\view\ViewInChief
{
    private array $pageSettingsList = array();

    public function __construct()
    {
        $this->pageSettingsList = array(
                                        "pageTitle" => "Your CRM - Accueil",
                                        "activeHome" => "active",
                                        "activeCat" => "",
                                        "activeProsp" => "",
                                        "activeClient" => ""
                                    );
    }

    public function buildOrder(array $homeTableData)
    {
        $this->pageContent = file_get_contents('public/html/head.html');
        $this->pageContent .= file_get_contents('public/html/nav.html');

        $this->pageSetup($this->pageSettingsList); // configuration de la page

        // construction du tableau des 3 derniers clients
        $this->pageContent .= file_get_contents('public/html/home/table/homeclienttabletop.html');
        $this->tableRowsBuilder($homeTableData['client']);
        $this->pageContent .= file_get_contents('public/html/home/table/hometablebottom.html');

        // construction du tableau des 3 derniers prospects
        $this->pageContent .= file_get_contents('public/html/home/table/homeprospecttabletop.html');
        $this->tableRowsBuilder($homeTableData['prosp']);
        $this->pageContent .= file_get_contents('public/html/home/table/hometablebottom.html');

        $this->pageContent .= file_get_contents('public/html/footer.html');

        $this->pageDisplay();
    }

    private function tableRowsBuilder(array $tableData)
    {
        $rowsArray = \MVCExo\view\TableBuilder::clientAndProspTableRowBuilder($tableData);

        foreach ($rowsArray as $value) {
            $this->pageContent .= $value;
        }
    }
}
