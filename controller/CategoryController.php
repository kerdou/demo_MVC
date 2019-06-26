<?php

require_once "controller/ControllerInChief.php";
require_once "view/catview/table/CategoryTableView.php";
require_once "view/catview/form/CategoryFormView.php";
require_once "model/CategoryModel.php";

/**
 * Controleur de la section 'catégorie'
 * Fille de la classe 'ControllerInChief' située dans le même repertoire.
 * 'ControllerInChief' n'est pas utile à 'CategoryController' mais je l'ai rattaché pour standardiser tout
 * les classes controller.
 */
class CategoryController extends ControllerInChief
{

    /**
     * @var objet uniquement l'affichage du tableau de la section catégorie
     * @access private
     */
    private $categoryTableView;
    
    /**
     * @var objet uniquement l'affichage des formulaires de la section catégorie
     * @access private
     */
    private $categoryFormView;

    /**
     * @var objet récuperation, ajout, modifications et suppressions dans la base pour la table 'category'
     * @access private
     */
    private $categoryModel;

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
    public function __construct()
    {
        $this->categoryTableView = new CategoryTableView();
        $this->categoryFormView = new CategoryFormView();
        $this->categoryModel = new CategoryModel();

        // Si le $_GET n'est pas vide, récupérer son contenu sinon lui assigner l'action 'getTable'
        $this->getGather = (!empty($_GET))? $_GET : array('action'=>'getTableActionFromGet');
        
        // Si le $_POST n'est pas vide, récupérer son contenu et le nettoyer avec la méthode input_cleanup() sinon le laisser tel quel
        $this->postGather = (isset($_POST))? $this->input_cleanup($_POST) : null; // input_cleanup() est placée dans ControllerInChief.php
    }


    /**
     * si le $_POST est vide, la liste des catégories s'affiche
     * si le $_POST n'est pas vide on lance la bonne méthode du ProspectModel puis on les affiche sur une table
     * @access public
     * appelé par index.php
     */
    public function getTableActionFromGet(){
        if (empty($this->postGather)) {
            $this->realGetTable(); // leads to the current file
        } else {
            $postChecks = $this->categoryFormChecks(); // leads to controller/ControllerInChief.php
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
     * récupération de la methode action à effectuer
     * contacter le bon modele et lancer la bonne méthode d'action
     * @access public
     * appelé par getTableActionFromGet()
     */      
    public function modelMethodLauncher() {
        $whichModel = $this->postGather['model'].'Model';
        $modelMethod = $this->postGather['action'];
        $this->$whichModel->$modelMethod($this->postGather); //leads to model/CategoryModel.php
    }

    /**
     * récupération des données des catgories puis affichage de ces données dans le tableau
     * @access public
     * appelé par getTableActionFromGet()
     */
    public function realGetTable() {
        $catTableData = $this->categoryModel->catTableGet(); // leads to model/CategoryModel.php
        $this->categoryTableView->catTablePrepare($catTableData); // leads to view/catview/table/CategoryTableView.php
    }

    /**
     * affichage du formulaire d'ajout
     * @access public
     * appelé par index.php
     */
    public function addActionFromGet() {
        $this->categoryFormView->addFormSettings(); // leads to view/catview/form/CategoryFormView.php
    }

    /**
     * affichage du formulaire de modification
     * @access public
     * appelé par index.php
     */
    public function editActionFromGet() {
        $this->categoryFormView->editFormSettings($this->getGather); // leads to view/catview/form/CategoryFormView.php
    }

    /**
     * affichage du formulaire de suppression
     * @access public
     * appelé par index.php
     */
    public function deleteActionFromGet() {
        $this->categoryFormView->deleteFormSettings($this->getGather); // leads to view/catview/form/CategoryFormView.php
    }
}    
