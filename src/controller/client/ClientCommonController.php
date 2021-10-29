<?php

namespace MVCExo\controller\client;

use MVCExo\Autoloader;

Autoloader::register();

abstract class ClientCommonController
{
    protected object $clientModel; // Objet de récuperation des données de la DB pour la table 'category'
    protected object $clientTableView; // Objet d'affichage du tableau de la section catégorie

    /** Si on init $categoryModel dans __construct, ça plante. L'init se passe trop tôt.
     * * Avec cette méthode on contourne le probléme.
     */
    protected function instanciateModel()
    {
        $this->clientModel = new \MVCExo\model\ClientModel();
    }


    /** Récupération des données des catégories puis affichage de ces données dans le tableau
     * * Si on met met $categoryTableView dans __constuct, ça plante. L'init se passe trop tôt.
     * * Avec cette méthode on contourne le probléme.
     */
    protected function displayClientPage()
    {
        $tableData = $this->clientModel->selectAllClients();

        $this->clientTableView = new \MVCExo\view\prospclientview\clientview\table\ClientTableViewBuilder();
        $this->clientTableView->buildOrder($tableData);
    }
}
