<?php

namespace MVCExo\controller\category;

use MVCExo\Autoloader;

Autoloader::register();

/** Controleur de la section 'catégorie' */
class CategoryGetController extends CategoryCommonController
{
    /** Récupére [$_GET['action']] et lance l'affichage de la page voulue */
    public function actionReceiver(array $cleanedUpGet)
    {
        $this->instanciateModel();

        if (isset($cleanedUpGet['action'])) {
            switch ($cleanedUpGet['action']) {
                case 'getTable':
                    $this->displayAllCategories();
                    break;

                case 'add':
                    $categoryFormView = new \MVCExo\view\catview\form\CatFormViewBuilder();
                    $categoryFormView->buildOrder('displayCatAddForm');
                    break;

                case 'edit':
                    $categoryFormView = new \MVCExo\view\catview\form\CatFormViewBuilder();
                    $categoryFormView->buildOrder('displayCatEditForm', $cleanedUpGet);
                    break;

                case 'delete':
                    $categoryFormView = new \MVCExo\view\catview\form\CatFormViewBuilder();
                    $categoryFormView->buildOrder('displayCatDeleteForm', $cleanedUpGet);
                    break;

                default:
                    $this->displayAllCategories();
            }
        } else {
            $this->displayAllCategories();
        }
    }


    /** Récupération des données des catégories puis affichage de ces données dans le tableau
     * * Si on met met $categoryTableView dans __constuct, ça plante. L'init se passe trop tôt.
     * * Avec cette méthode on contourne le probléme.
     */
    private function displayAllCategories()
    {
        $catTableData = $this->categoryModel->selectAllCategories();
        $this->categoryTableView = new \MVCExo\view\catview\table\CatTableViewBuilder();
        $this->categoryTableView->buildOrder($catTableData);
    }
}
