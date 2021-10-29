<?php

namespace MVCExo\controller\prospect;

use MVCExo\Autoloader;

Autoloader::register();

abstract class ProspectCommonController
{
    protected object $prospectModel; // Objet de récuperation des données de la DB pour la table 'category'
    protected object $prospectTableView; // Objet d'affichage du tableau de la section catégorie


    /** Si on init $prospectModel dans __construct, ça plante. L'init se passe trop tôt.
     * * Avec cette méthode on contourne le probléme.
     */
    protected function instanciateModel()
    {
        $this->prospectModel = new \MVCExo\model\ProspectModel();
    }


    /** Récupération des données des catégories puis affichage de ces données dans le tableau
     * * Si on met $prospectTableView dans __constuct, ça plante. L'init se passe trop tôt.
     * * Avec cette méthode on contourne le probléme.
     */
    protected function displayProspPage()
    {
        $tableData = $this->prospectModel->selectAllProspects();

        $this->prospectTableView = new \MVCExo\view\prospclientview\prospview\table\ProspTableViewBuilder();
        $this->prospectTableView->buildOrder($tableData);
    }
}
