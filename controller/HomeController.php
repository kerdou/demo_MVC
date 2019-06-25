<?php

require_once "controller/ControllerInChief.php";
require_once "view/homeview/table/HomeTableView.php";
require_once "model/HomeModel.php";

/**
 * Controleur de la section 'accueil'
 * Fille de la classe 'ControllerInChief' située dans le même repertoire.
 * 'ControllerInChief' n'est pas utile à 'HomeController' mais je l'ai rattaché pour standardiser tout
 * les classes controller.
 */
class HomeController extends ControllerInChief {

    /**
     * @var objet uniquement l'affichage des tableaux de la section accueil
     * @access private 
     */
    private $homeTableView;

    /**
     * @var objet récuperation dans la base pour la table 'user'
     * @access private
     */
    private $homeModel;

    /**
     * @var array récupération des données du $_GET
     * @access private
     */
    private $getGather;



    /**
     * construction automatique des objets et récupération de $_GET et $_POST
     * @access public
     */
    public function __construct() {
        $this->homeTableView = new HomeTableView();
        $this->homeModel = new HomeModel();

        // Si le $_GET n'est pas vide, récupérer son contenu sinon lui assigner l'action 'getTable'
        $this->getGather = (!empty($_GET))? $_GET : array('action'=>'getTable');
    }

    /**
     * récupération des données des 3 derniers clients et 3 derniers prospects puis affichage
     * @access public
     * appelé par index.php
     */
    public function getTableActionFromGet(){
        $homeTableData = $this->homeModel->homeTableGet(); // leads to model/HomeModel.php
        $this->homeTableView->tablePrepare($homeTableData); // leads to view/homeview/table/HomeTableView.php
    }
}        
