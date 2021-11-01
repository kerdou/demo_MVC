<?php

namespace MVCExo\view\prospclientview\clientview\form;

use MVCExo\Autoloader;

Autoloader::register();

abstract class ClientFormAssemblyLine extends \MVCExo\view\prospclientview\clientview\ClientPageAssemblyLine
{
    protected function formSettingsListStorage(string $whishedFormMode, array $clientTableData = null)
    {
        $formSettingsList = array();

        switch ($whishedFormMode) {
            case 'addClientForm':
                $formSettingsList = array(
                    "formTitle" => "Ajout d'un client",
                    "readonly_inputs" => "",

                    "formAction" => "index.php?controller=clientPost",

                    "catIdRowHide" => "d-none",
                    "catIdValue" => "",

                    "usIdRowHide" => "d-none",
                    "usIdValue" => "",

                    "modelRowHide" => "d-none",
                    "modelValue" => "client",

                    "statusRowHide" => "d-none",

                    "lastnameValue" => "",
                    "firstnameValue" => "",
                    "addressValue" => "",
                    "postcodeValue" => "",
                    "cityValue" => "",
                    "commentField" => "",

                    "buttonAction" => "add",
                    "buttonText" => "Ajouter"
                );
                break;

            case 'editClientForm':
                $formSettingsList = array(
                    "formTitle" => "Modification d'un client",
                    "readonly_inputs" => "",

                    "formAction" => "index.php?controller=clientPost",

                    "catIdRowHide" => "d-none",
                    "catIdValue" => $clientTableData['catId'],

                    "usIdRowHide" => "d-none",
                    "usIdValue" => $clientTableData['usId'],

                    "modelRowHide" => "d-none",
                    "modelValue" => "client",

                    "statusRowHide" => "d-none",

                    "lastnameValue" => $clientTableData['usLastname'],
                    "firstnameValue" => $clientTableData['usFirstname'],
                    "addressValue" => $clientTableData['usAddress'],
                    "postcodeValue" => $clientTableData['usPostcode'],
                    "cityValue" => $clientTableData['usCity'],
                    "commentField" => $clientTableData['usComment'],

                    "buttonAction" => "edit",
                    "buttonText" => "Modifier"
                );
                break;

            case 'deleteClientForm':
                $formSettingsList = array(
                    "formTitle" => "Suppression d'un client",
                    "readonly_inputs" => "readonly",

                    "formAction" => "index.php?controller=clientPost",

                    "catIdRowHide" => "d-none",
                    "catIdValue" => $clientTableData['catId'],

                    "usIdRowHide" => "d-none",
                    "usIdValue" => $clientTableData['usId'],

                    "modelRowHide" => "d-none",
                    "modelValue" => "client",

                    "statusRowHide" => "d-none",

                    "lastnameValue" => $clientTableData['usLastname'],
                    "firstnameValue" => $clientTableData['usFirstname'],
                    "addressValue" => $clientTableData['usAddress'],
                    "postcodeValue" => $clientTableData['usPostcode'],
                    "cityValue" => $clientTableData['usCity'],
                    "commentField" => $clientTableData['usComment'],

                    "buttonAction" => "delete",
                    "buttonText" => "Supprimer"
                );
                break;
        }

        return $formSettingsList;
    }
}
