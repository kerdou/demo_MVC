<?php

namespace MVCExo\controller\prospect;

use MVCExo\Autoloader;

Autoloader::register();


/** Controleur de la section 'catégorie' */
class ProspectGetController extends ProspectCommonController
{
    private array $getContent = array(); // Données provenants de $_GET
    private object $prospectFormView; // Objet d'affichage des formulaires de la section catégorie


    /** Construction automatique des objets et récupération de $_GET et $_POST */
    public function __construct()
    {
        $this->prospectFormView = new \MVCExo\view\prospclientview\prospview\form\ProspFormViewBuilder();
    }


    /** Récupére le $_GET['action'] et lance l'action voulue */
    public function actionReceiver($cleanedUpGet)
    {
        $this->getContent = $cleanedUpGet;
        $this->instanciateModel(); // instanciation du modele

        if (isset($this->getContent['action'])) {
            switch ($this->getContent['action']) {
                case 'getTable':
                    $this->displayProspPage();
                    break;

                case 'add':
                    $this->prospectFormView->buildOrder('displayProspAddForm');
                    break;

                case 'edit':
                    $this->prospectFormView->buildOrder('displayProspEditForm', $this->getContent);
                    break;

                case 'delete':
                    $this->prospectFormView->buildOrder('displayProspDeleteForm', $this->getContent);
                    break;

                default:
                    $this->displayProspPage();
            }
        } else {
            $this->displayProspPage();
        }
    }
}
