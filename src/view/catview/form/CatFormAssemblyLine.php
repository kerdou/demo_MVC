<?php

namespace MVCExo\view\catview\form;

use MVCExo\Autoloader;

Autoloader::register();

abstract class CatFormAssemblyLine extends \MVCExo\view\catview\CatPageAssemblyLine
{
    protected function formsSettingsListStorage(string $whishedFormMode, array $catTableData = null)
    {
        $formSettingsList = array();

        switch ($whishedFormMode) {
            case 'addCatForm':
                $formSettingsList = array(
                    "formTitle" => "Ajout d'une catégorie",
                    "readonly_inputs" => "",

                    "catIdRowHide" => "d-none",
                    "catIdValue" => "",

                    "modelRowHide" => "d-none",

                    "lastnameRowHide" => "",
                    "lastnameValue" => "",

                    "commentRowHide" => "",
                    "commentField" => "",

                    "buttonAction" => "add",
                    "buttonText" => "Ajouter"
                );
                break;

            case 'editCatForm':
                $formSettingsList = array(
                    "formTitle" => "Modification d'une catégorie",
                    "readonly_inputs" => "",

                    "catIdRowHide" => "d-none",
                    "catIdValue" => $catTableData['catId'],

                    "modelRowHide" => "d-none",

                    "lastnameRowHide" => "",
                    "lastnameValue" => $catTableData['catName'],

                    "commentRowHide" => "",
                    "commentField" => $catTableData['catDescript'],

                    "buttonAction" => "edit",
                    "buttonText" => "Modifier"
                );
                break;

            case 'deleteCatForm':
                $formSettingsList = array(
                    "formTitle" => "Suppression d'une catégorie",
                    "readonly_inputs" => "readonly",

                    "catIdRowHide" => "d-none",
                    "catIdValue" => $catTableData['catId'],

                    "modelRowHide" => "d-none",

                    "lastnameRowHide" => "",
                    "lastnameValue" => $catTableData['catName'],

                    "commentRowHide" => "",
                    "commentField" => $catTableData['catDescript'],

                    "buttonAction" => "delete",
                    "buttonText" => "Supprimer"
                );
                break;
        }

        return $formSettingsList;
    }


    /** Configure le titre du formulaire de catégorie, tout ses paramètres et tout ses champs puis affichage de la page
     * @param $formSettings array contenant le paramêtrage du tableau.
     */
    protected function catFormConfigurator(array $formSettings)
    {
        $this->pageContent = str_replace("{formTitle}", $formSettings["formTitle"], $this->pageContent);
        $this->pageContent = str_replace("{readonly_inputs}", $formSettings["readonly_inputs"], $this->pageContent);

        $this->pageContent = str_replace("{catIdRowHide}", $formSettings["catIdRowHide"], $this->pageContent);
        $this->pageContent = str_replace("{catIdValue}", $formSettings["catIdValue"], $this->pageContent);

        $this->pageContent = str_replace("{modelRowHide}", $formSettings["modelRowHide"], $this->pageContent);

        $this->pageContent = str_replace("{lastnameRowHide}", $formSettings["lastnameRowHide"], $this->pageContent);
        $this->pageContent = str_replace("{lastnameValue}", $formSettings["lastnameValue"], $this->pageContent);

        $this->pageContent = str_replace("{commentRowHide}", $formSettings["commentRowHide"], $this->pageContent);
        $this->pageContent = str_replace("{commentField}", $formSettings["commentField"], $this->pageContent);

        $this->pageContent = str_replace("{buttonAction}", $formSettings["buttonAction"], $this->pageContent);
        $this->pageContent = str_replace("{buttonText}", $formSettings["buttonText"], $this->pageContent);
    }
}
