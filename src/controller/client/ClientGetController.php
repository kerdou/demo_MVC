<?php

namespace MVCExo\controller\client;

use MVCExo\Autoloader;

Autoloader::register();

/** Controleur de la section 'catégorie' */
class ClientGetController extends ClientCommonController
{
    /** Récupére [$_GET['action']] et lance l'affichage de la page voulue */
    public function actionReceiver(array $cleanedUpGet)
    {
        $this->instanciateModel(); // instanciation du modéle

        if (isset($cleanedUpGet['action'])) {
            switch ($cleanedUpGet['action']) {
                case 'getTable':
                    $this->displayClientPage();
                    break;

                case 'add':
                    $clientFormView = new \MVCExo\view\prospclientview\clientview\form\ClientFormViewBuilder();
                    $clientFormView->buildOrder('displayClientAddForm');
                    break;

                case 'edit':
                    $clientFormView = new \MVCExo\view\prospclientview\clientview\form\ClientFormViewBuilder();
                    $clientFormView->buildOrder('displayClientEditForm', $cleanedUpGet);
                    break;

                case 'delete':
                    $clientFormView = new \MVCExo\view\prospclientview\clientview\form\ClientFormViewBuilder();
                    $clientFormView->buildOrder('displayClientDeleteForm', $cleanedUpGet);
                    break;

                default:
                    $this->displayClientPage();
            }
        } else {
            $this->displayClientPage();
        }
    }


    /** Récupération des données des catégories puis affichage de ces données dans le tableau
     * * Si on met met $categoryTableView dans __constuct, ça plante. L'init se passe trop tôt.
     * * Avec cette méthode on contourne le probléme.
     */
    private function displayClientPage()
    {
        $tableData = $this->clientModel->selectAllClients();
        $clientTableView = new \MVCExo\view\prospclientview\clientview\table\ClientTableViewBuilder();
        $clientTableView->buildOrder($tableData);
    }
}
