<?php

namespace MVCExo\view\catview;

use MVCExo\Autoloader;

Autoloader::register();

abstract class CatPageAssemblyLine extends \MVCExo\view\ViewInChief
{
    /** Liste des paramêtrages pour la page */
    protected function pageSettingsListStorage()
    {
        $pageSettingsList = array(
            "pageTitle" => "Your CRM - Catégories",
            "activeHome" => "",
            "activeCat" => "active",
            "activeProsp" => "",
            "activeClient" => ""
        );

        return $pageSettingsList;
    }
}
