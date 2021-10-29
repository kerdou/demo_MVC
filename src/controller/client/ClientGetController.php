<?php

namespace MVCExo\controller\client;

use MVCExo\Autoloader;

Autoloader::register();

/** Controleur de la section 'catégorie' */
class ClientGetController extends ClientCommonController
{
    private array $getContent = array(); // Données provenants de $_GET
    private object $clientFormView; // Objet d'affichage des formulaires de la section catégorie

    public function __construct()
    {
        $this->clientFormView = new \MVCExo\view\prospclientview\clientview\form\ClientFormViewBuilder();
    }


    /** Récupére [$_GET['action']] et lance l'affichage de la page voulue */
    public function actionReceiver(array $cleanedUpGet)
    {
        $this->getContent = $cleanedUpGet;
        $this->instanciateModel(); // instanciation du modéle

        if (isset($this->getContent['action'])) {
            switch ($this->getContent['action']) {
                case 'getTable':
                    $this->displayClientPage();
                    break;

                case 'add':
                    $this->clientFormView->buildOrder('displayClientAddForm');
                    break;

                case 'edit':
                    $this->clientFormView->buildOrder('displayClientEditForm', $this->getContent);
                    break;

                case 'delete':
                    $this->clientFormView->buildOrder('displayClientDeleteForm', $this->getContent);
                    break;

                default:
                    $this->displayClientPage();
            }
        } else {
            $this->displayClientPage();
        }
    }
}
