<?php

namespace MVCExo\view\prospclientview\prospview\form;

use MVCExo\Autoloader;

Autoloader::register();

abstract class ProspFormAssemblyLine extends \MVCExo\view\prospclientview\prospview\ProspPageAssemblyLine
{
    protected function formSettingsListStorage(string $whishedFormMode, array $prospTableData = null)
    {
        $formSettingsList = array();

        switch ($whishedFormMode) {
            case 'addProspForm':
                $formSettingsList = array(
                    "formTitle" => "Ajout d'un prospect",
                    "readonly_inputs" => "",

                    "formAction" => "index.php?controller=prospect",

                    "catIdRowHide" => "d-none",
                    "catIdValue" => "",

                    "usIdRowHide" => "d-none",
                    "usIdValue" => "",

                    "modelRowHide" => "d-none",
                    "modelValue" => "prospect",

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

            case 'editProspForm':
                $formSettingsList = array(
                    "formTitle" => "Modification d'un prospect",
                    "readonly_inputs" => "",

                    "formAction" => "index.php?controller=prospect",

                    "catIdRowHide" => "d-none",
                    "catIdValue" => $prospTableData['catId'],

                    "usIdRowHide" => "d-none",
                    "usIdValue" => $prospTableData['usId'],

                    "modelRowHide" => "d-none",
                    "modelValue" => "prospect",

                    "statusRowHide" => "",

                    "lastnameValue" => $prospTableData['usLastname'],
                    "firstnameValue" => $prospTableData['usFirstname'],
                    "addressValue" => $prospTableData['usAddress'],
                    "postcodeValue" => $prospTableData['usPostcode'],
                    "cityValue" => $prospTableData['usCity'],
                    "commentField" => $prospTableData['usComment'],

                    "buttonAction" => "edit",
                    "buttonText" => "Modifier"
                );
                break;

            case 'deleteProspForm':
                $formSettingsList = array(
                    "formTitle" => "Suppression d'un prospect",
                    "readonly_inputs" => "readonly",

                    "formAction" => "index.php?controller=prospect",

                    "catIdRowHide" => "d-none",
                    "catIdValue" => $prospTableData['catId'],

                    "usIdRowHide" => "d-none",
                    "usIdValue" => $prospTableData['usId'],

                    "modelRowHide" => "d-none",
                    "modelValue" => "prospect",

                    "statusRowHide" => "d-none",

                    "lastnameValue" => $prospTableData['usLastname'],
                    "firstnameValue" => $prospTableData['usFirstname'],
                    "addressValue" => $prospTableData['usAddress'],
                    "postcodeValue" => $prospTableData['usPostcode'],
                    "cityValue" => $prospTableData['usCity'],
                    "commentField" => $prospTableData['usComment'],

                    "buttonAction" => "delete",
                    "buttonText" => "Supprimer"
                );
                break;
        }

        return $formSettingsList;
    }
}
