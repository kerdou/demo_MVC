<?php

require_once "controller/ControllerInChief.php";
require_once "view/prospclientview/clientview/table/ClientTableView.php";
require_once "view/prospclientview/clientview/form/ClientFormView.php";
require_once "model/ClientModel.php";

/**
 * Controleur de la section 'client'
 * 
 * Fille de la classe 'ControllerInChief' située dans le même repertoire.
 */
class ClientController extends ControllerInChief{

    /**
     * @var objet uniquement l'affichage du tableau de la section client
     * @access private 
     */
    private $clientTableView;

    /**
     * @var objet uniquement l'affichage des formulaires de la section client
     * @access private 
     */
    private $clientFormView;

    /**
     * @var objet récuperation, ajout, modifications et suppressions dans la base pour la table 'user'
     * @access private
     */
    private $clientModel;

    /**
     * @var array récupération des données du $_GET
     * @access private
     */
    private $getGather;

    /**
     * @var array récupération des données du $_POST
     * @access private
     */
    private $postGather;

    /**
     * construction automatique des objets et récupération de $_GET et $_POST
     * @access public
     */
    public function __construct() {
        $this->clientTableView = new ClientTableView();
        $this->clientFormView = new ClientFormView();
        $this->clientModel = new ClientModel();

        // Si le $_GET n'est pas vide, récupérer son contenu sinon lui assigner l'action 'getTable'
        $this->getGather = (!empty($_GET))? $_GET : array('action'=>'getTableActionFromGet');

        // Si le $_POST n'est pas vide, récupérer son contenu sinon le laisser tel quel
        $this->postGather = (isset($_POST))? $this->input_cleanup($_POST) : null; // input_cleanup() est placée dans ControllerInChief.php
    }

    /**
     * si le $_POST est vide, la liste des clients s'affiche
     * si le $_POST n'est pas vide on vérifie que ses données sont conformes
     * si les données sont conformes ($postChecks vide) on les envoie à la bonne méthode du ClientModel
     * si les données ne sont pas conformes ($postChecks pas vide) on affiche un message d'erreur et on affiche la liste des clients
     * @access public
     * appelé par index.php
     */
    public function getTableActionFromGet(){
        if(empty($this->postGather)){            
            $this->realGetTable(); // leads to the current file
        } else {
            $postChecks = $this->prospClientFormChecks(); // leads to controller/ControllerInChief.php
            if (empty($postChecks)){
                $this->modelMethodLauncher(); // leads to the current file 
                $this->realGetTable(); // leads to the current file                
            } else {
                echo $postChecks;
                $this->realGetTable(); // leads to the current file
            }
        }
    }

    /**
     * récupération du model à contacter ensuite
     * récupération de le methode action à effectuer
     * contacter le bon modele et lancer la bonne méthode d'action
     * @access public
     * appelé par getTableActionFromGet()
     */
    public function modelMethodLauncher() {
        $whichModel = $this->postGather['model'].'Model';
        $modelMethod = $this->postGather['action'];
        $this->$whichModel->$modelMethod($this->postGather); // leads to model/ClientModel.php     
    }

    /**
     * récupération des données des clients puis affichage de ces données dans le tableau
     * @access public
     * appelé par getTableActionFromGet()
     */
    public function realGetTable(){
        $tableData = $this->clientModel->getClientTable(); // leads to model/ClientModel.php  
        $this->clientTableView->tablePrepare($tableData); // leads to view/prospclientview/table/ClientTableView.php
    }    

    /**
     * affichage du formulaire d'ajout
     * @access public
     * appelé par index.php
     */
    public function addActionFromGet(){
        $this->clientFormView->addFormSettings(); // leads to view/prospclientview/form/ClientFormView.php
    }    

    /**
     * affichage du formulaire de modification
     * @access public
     * appelé par index.php
     */                
    public function editActionFromGet(){
        $this->clientFormView->editFormSettings($this->getGather); // leads to view/prospclientview/form/ClientFormView.php
    }

    /**
     * affichage du formulaire de suppression
     * @access public
     * appelé par index.php
     */
    public function deleteActionFromGet(){
        $this->clientFormView->deleteFormSettings($this->getGather); // leads to view/prospclientview/form/ClientFormView.php 
    }    
}