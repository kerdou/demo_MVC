<?php

namespace MVCExo\view\prospclientview\prospview;

use MVCExo\Autoloader;

Autoloader::register();

abstract class ProspPageAssemblyLine extends \MVCExo\view\prospclientview\ProspClientFormAndTableConfigurator
{

    /** liste des paramêtrages de la page */
    protected function pageSettingsListStorage()
    {
        $pageSettingsList = array(
            "pageTitle" => "Your CRM - Prospects",
            "activeHome" => "",
            "activeCat" => "",
            "activeProsp" => "active",
            "activeClient" => ""
        );

        return $pageSettingsList;
    }
}
