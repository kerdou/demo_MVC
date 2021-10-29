<?php

namespace MVCExo\controller\category;

use MVCExo\Autoloader;

Autoloader::register();

abstract class CategoryCommonController
{
    protected object $categoryModel; // Objet de récuperation des données de la DB pour la table 'category'
    protected object $categoryView; // Objet d'affichage du tableau de la section catégorie


    /** Si on init $categoryModel dans __construct, ça plante. L'init se passe trop tôt.
     * Avec cette méthode on contourne le probléme.
     */
    protected function instanciateModel()
    {
        $this->categoryModel = new \MVCExo\model\CategoryModel();
    }


    /** Récupération des données des catégories puis affichage de ces données dans le tableau
     * * Si on met met $categoryTableView dans __constuct, ça plante. L'init se passe trop tôt.
     * * Avec cette méthode on contourne le probléme.
     */
    protected function displayAllCategories()
    {
        $catTableData = $this->categoryModel->selectAllCategories();

        $this->categoryTableView = new \MVCExo\view\catview\table\CatTableViewBuilder();
        $this->categoryTableView->buildOrder($catTableData);
    }
}
