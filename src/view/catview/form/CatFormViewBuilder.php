<?php

namespace MVCExo\view\catview\form;

use MVCExo\Autoloader;

Autoloader::register();

class CatFormViewBuilder extends CatFormAssemblyLine
{
    public function buildOrder(string $mode, array $catTableData = null)
    {
        $this->pageContent = file_get_contents('public/html/head.html');
        $this->pageContent .= file_get_contents('public/html/nav.html');

        $pageSettingsList = $this->pageSettingsListStorage();
        $this->pageSetup($pageSettingsList);

        switch ($mode) {
            case 'displayCatAddForm':
                $this->pageContent .= file_get_contents('public/html/category/form/catform.html');  // inclut le template du formulaire  de catégorie
                $formSettingsList = $this->formsSettingsListStorage('addCatForm');
                $this->catFormConfigurator($formSettingsList);
                break;

            case 'displayCatEditForm':
                $this->pageContent .= file_get_contents('public/html/category/form/catform.html');  // inclut le template du formulaire  de catégorie
                $formSettingsList = $this->formsSettingsListStorage('editCatForm', $catTableData);
                $this->catFormConfigurator($formSettingsList);
                break;

            case 'displayCatDeleteForm':
                $this->pageContent .= file_get_contents('public/html/category/form/catform.html');  // inclut le template du formulaire  de catégorie
                $formSettingsList = $this->formsSettingsListStorage('deleteCatForm', $catTableData);
                $this->catFormConfigurator($formSettingsList);
                break;
        }

        $this->pageContent .= file_get_contents('public/html/footer.html');

        $this->pageDisplay();
    }
}
