<?php

require_once "controller/ControllerInChief.php";
require_once "view/prospclientview/prospview/table/ProspectTableView.php";
require_once "view/prospclientview/prospview/form/ProspectFormView.php";
require_once "model/ProspectModel.php";

/**
 * Controleur de la section 'client'
 *  
 * Fille de la classe 'ControllerInChief' située dans le même repertoire.
 */
class ProspectController  extends ControllerInChief{

    /**
     * @var objet uniquement l'affichage du tableau de la section prospect
     * @access private 
     */
    private $prospectTableView;

    /**
     * @var objet uniquement l'affichage des formulaires de la section prospect
     * @access private 
     */
    private $prospectFormView;

    /**
     * @var objet récuperation, ajout, modifications et suppressions dans la base pour la table 'user'
     * @access private
     */
    private $prospectModel;    

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
        $this->prospectTableView = new ProspectTableView();
        $this->prospectFormView = new ProspectFormView();
        $this->prospectModel = new ProspectModel();

        // Si le $_GET n'est pas vide, récupérer son contenu sinon lui assigner l'action 'getTable'
        $this->getGather = (!empty($_GET))? $_GET : array('action'=>'getTableActionFromGet');
        
        // Si le $_POST n'est pas vide, récupérer son contenu sinon le laisser tel quel
        $this->postGather = (isset($_POST))? $this->input_cleanup($_POST) : null; // input_cleanup() est placée dans ControllerInChief.php
    }

    /**
     * si le $_POST est vide, la liste des prospects s'affiche
     * si le $_POST n'est pas vide on vérifie que ses données sont conformes
     * si les données sont conformes ($postChecks vide) on les envoie à la bonne méthode du ProspectModel
     * si les données ne sont pas conformes ($postChecks pas vide) on affiche un message d'erreur et on affiche la liste des prospects
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
        $this->$whichModel->$modelMethod($this->postGather); //leads to model/ProspectModel.php        
    }

    /**
     * récupération des données des prospects puis affichage de ces données dans le tableau
     * @access public
     * appelé par getTableActionFromGet()
     */
    public function realGetTable(){
        $tableData = $this->prospectModel->getProspTable(); // leads to model/ProspectModel.php
        $this->prospectTableView->tablePrepare($tableData); // leads to view/prospclientview/table/ProspectTableView.php
    }

    /**
     * affichage du formulaire d'ajout
     * @access public
     * appelé par index.php
     */
    public function addActionFromGet(){
        $this->prospectFormView->addFormSettings(); // leads to view/prospclientview/form/ProspectFormView.php
    }

    /**
     * affichage du formulaire de modification
     * @access public
     * appelé par index.php
     */                  
    public function editActionFromGet(){
        $this->prospectFormView->editFormSettings($this->getGather); // leads to view/prospclientview/form/ProspectFormView.php
    }

    /**
     * affichage du formulaire de suppression
     * @access public
     * appelé par index.php
     */
    public function deleteActionFromGet(){
        $this->prospectFormView->deleteFormSettings($this->getGather); // leads to view/prospclientview/form/ProspectFormView.php
    }    
}