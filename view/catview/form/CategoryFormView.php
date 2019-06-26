<?php

require_once "view/catview/CategoryView.php";

/**
 * Classe fille de la CategoryView dediée à la configuration de 
 * ses formulaires d'ajout, modification et suppression 
 */
class CategoryFormView extends CategoryView {

    /**
     * récupération des paramètres du formulaire d'ajout
     * puis configuration de la page
     * puis envoie des paramêtres du formulaire
     * @access public
     * appelée depuis le dispatch() case 'add' de controller/CategoryController 
     */
    public function addFormSettings(){

        $formSettings = array(  "formTitle"=>"Ajout d'une catégorie",
                                "readonly_inputs"=>"",

                                "catIdRowHide"=>"d-none",
                                "catIdValue"=>"",

                                "modelRowHide"=>"d-none",

                                "lastnameRowHide"=>"",
                                "lastnameValue"=>"",

                                "commentRowHide" =>"",
                                "commentField"=>"",

                                "buttonAction"=>"add",
                                "buttonText"=>"Ajouter");

        $this->pageSettings(); // leads to view/catview/CategoryView.php
        $this->catformSetup($formSettings); // leads to the current file.php
    }    



    /**
     * récupération des paramètres du formulaire de modification
     * puis configuration de la page
     * puis envoie des paramêtres du formulaire
     * @access public
     * @param $getGather array prevonant de $_GET
     * appelée depuis le dispatch() case 'edit' de controller/CategoryController 
     */    
    public function editFormSettings($getGather){
        $getGather = $this->htmlCharConvert($getGather); // leads to view/ViewInChief.php        

        $formSettings = array(  "formTitle"=>"Modification d'une catégorie",
                                "readonly_inputs"=>"",

                                "catIdRowHide"=>"d-none",
                                "catIdValue"=>$getGather['catId'],

                                "modelRowHide"=>"d-none",

                                "lastnameRowHide"=>"",
                                "lastnameValue"=>$getGather['catName'],

                                "commentRowHide" =>"",
                                "commentField"=>$getGather['catDescript'],

                                "buttonAction"=>"edit",
                                "buttonText"=>"Modifier");

        $this->pageSettings(); // lead to view/catview/CategoryView.php
        $this->catformSetup($formSettings); // leads to the current file
    } 
    
    

    /**
     * récupération des paramètres du formulaire de suppression
     * puis configuration de la page
     * puis envoie des paramêtres du formulaire
     * @access public
     * @param $getGather array prevonant de $_GET
     * appelée depuis le dispatch() case 'delete' de controller/CategoryController 
     */   
    public function deleteFormSettings($getGather){
        $getGather = $this->htmlCharConvert($getGather); // leads to view/ViewInChief.php

        $formSettings = array(  "formTitle"=>"Suppression d'une catégorie",
                                "readonly_inputs"=>"readonly",

                                "catIdRowHide"=>"d-none",
                                "catIdValue"=>$getGather['catId'],

                                "modelRowHide"=>"d-none",

                                "lastnameRowHide"=>"",
                                "lastnameValue"=>$getGather['catName'],

                                "commentRowHide" =>"",
                                "commentField"=>$getGather['catDescript'],

                                "buttonAction"=>"delete",
                                "buttonText"=>"Supprimer");

        $this->pageSettings(); // lead to view/catview/CategoryView.php
        $this->catformSetup($formSettings); // leads to the current file
    } 

    /**
     * configure le titre du formulaire de catégorie, tout ses paramètres et tout ses champs
     * puis affichage de la page
     * @access private
     * @param $formSettings array contenant le paramêtrage du tableau.
     * appelé depuis les autres fonctions de ce fichier      
     */  
    private function catFormSetup($formSettings) {
        $this->pageContent .= file_get_contents('public/html/category/form/catform.html');  // inclut le template du formulaire  de catégorie
        
        $this->pageContent = str_replace("{formTitle}",         $formSettings["formTitle"],         $this->pageContent);
        $this->pageContent = str_replace("{readonly_inputs}",   $formSettings["readonly_inputs"],   $this->pageContent);

        $this->pageContent = str_replace("{catIdRowHide}",      $formSettings["catIdRowHide"],      $this->pageContent);
        $this->pageContent = str_replace("{catIdValue}",        $formSettings["catIdValue"],        $this->pageContent); 

        $this->pageContent = str_replace("{modelRowHide}",      $formSettings["modelRowHide"],      $this->pageContent);         

        $this->pageContent = str_replace("{lastnameRowHide}",   $formSettings["lastnameRowHide"],   $this->pageContent);
        $this->pageContent = str_replace("{lastnameValue}",     $formSettings["lastnameValue"],     $this->pageContent);
        
        $this->pageContent = str_replace("{commentRowHide}",    $formSettings["commentRowHide"],    $this->pageContent);
        $this->pageContent = str_replace("{commentField}",      $formSettings["commentField"],      $this->pageContent);
        
        $this->pageContent = str_replace("{buttonAction}",      $formSettings["buttonAction"],      $this->pageContent);
        $this->pageContent = str_replace("{buttonText}",        $formSettings["buttonText"],        $this->pageContent);
        
        $this->pageDisplay(); // leads to view/ViewInChief.php
       }
}