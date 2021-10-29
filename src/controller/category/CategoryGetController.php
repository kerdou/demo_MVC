<?php

namespace MVCExo\controller\category;

use MVCExo\Autoloader;

Autoloader::register();

/** Controleur de la section 'catégorie' */
class CategoryGetController extends CategoryCommonController
{
    private array $getContent = array(); // Données provenants de $_GET

    public function __construct()
    {
        $this->categoryFormView = new \MVCExo\view\catview\form\CatFormViewBuilder();
    }


    /** Récupére [$_GET['action']] et lance l'affichage de la page voulue */
    public function actionReceiver(array $cleanedUpGet)
    {
        $this->getContent = $cleanedUpGet;
        $this->instanciateModel();

        if (isset($this->getContent['action'])) {
            switch ($this->getContent['action']) {
                case 'getTable':
                    $this->displayAllCategories();
                    break;

                case 'add':
                    $this->categoryFormView->buildOrder('displayCatAddForm');
                    break;

                case 'edit':
                    $this->categoryFormView->buildOrder('displayCatEditForm', $this->getContent);
                    break;

                case 'delete':
                    $this->categoryFormView->buildOrder('displayCatDeleteForm', $this->getContent);
                    break;

                default:
                    $this->displayAllCategories();
            }
        } else {
            $this->displayAllCategories();
        }
    }
}
