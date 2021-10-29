<?php

namespace MVCExo\view\prospclientview;

use MVCExo\Autoloader;

Autoloader::register();

abstract class ProspClientFormAndTableConfigurator extends \MVCExo\view\ViewInChief
{
    /** Configure le titre du formulaire de catégorie, tout ses paramètres et tout ses champs puis affichage de la page
     * @param $formSettings array contenant le paramêtrage du tableau.
     */
    protected function prospClientFormConfigurator(array $formSettings)
    {
        $this->pageContent = str_replace("{formTitle}", $formSettings["formTitle"], $this->pageContent);
        $this->pageContent = str_replace("{readonly_inputs}", $formSettings["readonly_inputs"], $this->pageContent);

        $this->pageContent = str_replace("{formAction}", $formSettings["formAction"], $this->pageContent);

        $this->pageContent = str_replace("{catIdRowHide}", $formSettings["catIdRowHide"], $this->pageContent);
        $this->pageContent = str_replace("{catIdValue}", $formSettings["catIdValue"], $this->pageContent);

        $this->pageContent = str_replace("{usIdRowHide}", $formSettings["usIdRowHide"], $this->pageContent);
        $this->pageContent = str_replace("{usIdValue}", $formSettings["usIdValue"], $this->pageContent);

        $this->pageContent = str_replace("{modelRowHide}", $formSettings["modelRowHide"], $this->pageContent);
        $this->pageContent = str_replace("{modelValue}", $formSettings["modelValue"], $this->pageContent);

        $this->pageContent = str_replace("{statusRowHide}", $formSettings["statusRowHide"], $this->pageContent);

        $this->pageContent = str_replace("{lastnameValue}", $formSettings["lastnameValue"], $this->pageContent);
        $this->pageContent = str_replace("{firstnameValue}", $formSettings["firstnameValue"], $this->pageContent);
        $this->pageContent = str_replace("{addressValue}", $formSettings["addressValue"], $this->pageContent);
        $this->pageContent = str_replace("{postcodeValue}", $formSettings["postcodeValue"], $this->pageContent);
        $this->pageContent = str_replace("{cityValue}", $formSettings["cityValue"], $this->pageContent);
        $this->pageContent = str_replace("{commentField}", $formSettings["commentField"], $this->pageContent);

        $this->pageContent = str_replace("{buttonAction}", $formSettings["buttonAction"], $this->pageContent);
        $this->pageContent = str_replace("{buttonText}", $formSettings["buttonText"], $this->pageContent);
    }

    protected function tableRowsBuilder(string $controller, array $tableData)
    {
        $rowsArray = \MVCExo\view\TableBuilder::prospAndClientTableRowWithButtonsBuilder($controller, $tableData);
        return $rowsArray;
    }
}
