<?php

namespace MVCExo\view\prospclientview\clientview\form;

use MVCExo\Autoloader;

Autoloader::register();

class ClientFormViewBuilder extends ClientFormAssemblyLine
{
    public function buildOrder(string $mode, array $catTableData = null)
    {
        $this->pageContent = file_get_contents('public/html/head.html');
        $this->pageContent .= file_get_contents('public/html/nav.html');

        $pageSettingsList = $this->pageSettingsListStorage();
        $this->pageSetup($pageSettingsList);

        // création et configuration des formulaires client
        switch ($mode) {
            case 'displayClientAddForm':
                $this->pageContent .= file_get_contents('public/html/prospclient/form/prospclientform.html');  // inclut le template du formulaire prospect/client
                $formSettingsList = $this->formSettingsListStorage('addClientForm');
                $this->prospClientFormConfigurator($formSettingsList);
                break;

            case 'displayClientEditForm':
                $this->pageContent .= file_get_contents('public/html/prospclient/form/prospclientform.html');  // inclut le template du formulaire prospect/client
                $formSettingsList = $this->formSettingsListStorage('editClientForm', $catTableData);
                $this->prospClientFormConfigurator($formSettingsList);
                break;

            case 'displayClientDeleteForm':
                $this->pageContent .= file_get_contents('public/html/prospclient/form/prospclientform.html');  // inclut le template du formulaire prospect/client
                $formSettingsList = $this->formSettingsListStorage('deleteClientForm', $catTableData);
                $this->prospClientFormConfigurator($formSettingsList);
                break;
        }

        $this->pageContent .= file_get_contents('public/html/footer.html');

        $this->pageDisplay();
    }
}
