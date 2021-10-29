<?php

namespace MVCExo\view\prospclientview\prospview\form;

use MVCExo\Autoloader;

Autoloader::register();

class ProspFormViewBuilder extends ProspFormAssemblyLine
{
    public function buildOrder(string $mode, array $prospTableData = null)
    {
        $this->pageContent = file_get_contents('public/html/head.html');
        $this->pageContent .= file_get_contents('public/html/nav.html');

        $pageSettingsList = $this->pageSettingsListStorage();
        $this->pageSetup($pageSettingsList);

        // création et configuration des formulaires client
        switch ($mode) {
            case 'displayProspAddForm':
                $this->pageContent .= file_get_contents('public/html/prospclient/form/prospclientform.html');  // inclut le template du formulaire prospect/client
                $formSettingsList = $this->formSettingsListStorage('addProspForm');
                $this->prospClientFormConfigurator($formSettingsList);
                break;

            case 'displayProspEditForm':
                $this->pageContent .= file_get_contents('public/html/prospclient/form/prospclientform.html');  // inclut le template du formulaire prospect/client
                $formSettingsList = $this->formSettingsListStorage('editProspForm', $prospTableData);
                $this->prospClientFormConfigurator($formSettingsList);
                break;

            case 'displayProspDeleteForm':
                $this->pageContent .= file_get_contents('public/html/prospclient/form/prospclientform.html');  // inclut le template du formulaire prospect/client
                $formSettingsList = $this->formSettingsListStorage('deleteProspForm', $prospTableData);
                $this->prospClientFormConfigurator($formSettingsList);
                break;
        }

        $this->pageContent .= file_get_contents('public/html/footer.html');

        $this->pageDisplay();
    }
}
