<?php

namespace MVCExo\controller\prospect;

use MVCExo\Autoloader;

Autoloader::register();


/** Controleur de la section 'catégorie' */
class ProspectGetController extends ProspectCommonController
{
    /** Récupére le $_GET['action'] et lance l'action voulue */
    public function actionReceiver($cleanedUpGet)
    {
        $this->instanciateModel(); // instanciation du modele

        if (isset($cleanedUpGet['action'])) {
            switch ($cleanedUpGet['action']) {
                case 'getTable':
                    $this->displayProspPage();
                    break;

                case 'add':
                    $prospectFormView = new \MVCExo\view\prospclientview\prospview\form\ProspFormViewBuilder();
                    $prospectFormView->buildOrder('displayProspAddForm');
                    break;

                case 'edit':
                    $prospectFormView = new \MVCExo\view\prospclientview\prospview\form\ProspFormViewBuilder();
                    $prospectFormView->buildOrder('displayProspEditForm', $cleanedUpGet);
                    break;

                case 'delete':
                    $prospectFormView = new \MVCExo\view\prospclientview\prospview\form\ProspFormViewBuilder();
                    $prospectFormView->buildOrder('displayProspDeleteForm', $cleanedUpGet);
                    break;

                default:
                    $this->displayProspPage();
            }
        } else {
            $this->displayProspPage();
        }
    }


    /** Récupération des données des catégories puis affichage de ces données dans le tableau
     * * Si on met $prospectTableView dans __constuct, ça plante. L'init se passe trop tôt.
     * * Avec cette méthode on contourne le probléme.
     */
    private function displayProspPage()
    {
        $tableData = $this->prospectModel->selectAllProspects();
        $prospectTableView = new \MVCExo\view\prospclientview\prospview\table\ProspTableViewBuilder();
        $prospectTableView->buildOrder($tableData);
    }
}
