<?php

namespace MVCExo\controller;

use MVCExo\Autoloader;

Autoloader::register();

/** Controleur de la section 'accueil' */
class HomeGetController
{
    private object $homeModel; // Récupére les données des 3 derniers clients et des 3 derniers prospects
    private object $homeView; // Affichage des tableaux de la section accueil

    public function __construct()
    {
        $this->homeModel = new \MVCExo\model\HomeModel();
        $this->homeView = new \MVCExo\view\homeview\HomeViewBuilder();
    }

    /** Récupération des données des 3 derniers clients et 3 derniers prospects puis affichage */
    public function displayHomePage()
    {
        $homeTableData = $this->homeModel->selectThreeLastProspAndThreeLastClients();
        $this->homeView->buildOrder($homeTableData);
    }
}
