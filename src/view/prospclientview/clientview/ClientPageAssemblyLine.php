<?php

namespace MVCExo\view\prospclientview\clientview;

use MVCExo\Autoloader;

Autoloader::register();

abstract class ClientPageAssemblyLine extends \MVCExo\view\prospclientview\ProspClientFormAndTableConfigurator
{
    /** Liste des paramêtrages de la page */
    protected function pageSettingsListStorage()
    {
        $pageSettingsList = array(
            "pageTitle" => "Your CRM - Clients",
            "activeHome" => "",
            "activeCat" => "",
            "activeProsp" => "",
            "activeClient" => "active"
        );

        return $pageSettingsList;
    }
}
