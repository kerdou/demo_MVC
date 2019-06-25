<?php

require_once "view/prospclientview/prospview/ProspectView.php";

/**
 * Classe fille de la ProspectView dediée à la configuration de 
 * ses formulaires d'ajout, modification et suppression 
 */
class ProspectFormView extends ProspectView {

    /**
     * récupération des paramètres du formulaire d'ajout
     * puis configuration de la page
     * puis envoie des paramêtres du formulaire
     * @access public
     * appelée depuis le dispatch() case 'add' de controller/ProspectController 
     */
    public function addFormSettings(){      

        $formSettings = array(  "formTitle"=>"Ajout d'un prospect",
                                "readonly_inputs"=>"",

                                "formAction"=>"index.php?controller=prospect",

                                "catIdRowHide"=>"d-none",
                                "catIdValue"=>"",

                                "usIdRowHide"=>"d-none",
                                "usIdValue"=>"",

                                "modelRowHide"=>"d-none",
                                "modelValue"=>"prospect",

                                "statusRowHide"=>"d-none",
                           
                                "lastnameValue"=>"",
                                "firstnameValue"=>"",
                                "addressValue"=>"",
                                "postcodeValue"=>"",
                                "cityValue"=>"",
                                "commentField"=>"",

                                "buttonAction"=>"add",
                                "buttonText"=>"Ajouter");

        $this->pageSettings(); // leads to view/catview/CategoryView.php
        $this->prospClientFormSetup($formSettings); // leads to view/ProspectClientView.php
    }  
    
    

    /**
     * récupération des paramètres du formulaire de modification
     * puis configuration de la page
     * puis envoie des paramêtres du formulaire
     * @access public
     * @param $getGather array prevonant de $_GET
     * appelée depuis le dispatch() case 'edit' de controller/ProspectController 
     */  
    public function editFormSettings($getGather){
        $getGather = $this->htmlCharConvert($getGather); // leads to view/ViewInChief.php     

        $formSettings = array(  "formTitle"=>"Modification d'un prospect",
                                "readonly_inputs"=>"",

                                "formAction"=>"index.php?controller=prospect",

                                "catIdRowHide"=>"d-none",
                                "catIdValue"=>$getGather['catId'],

                                "usIdRowHide"=>"d-none",
                                "usIdValue"=>$getGather['usId'],

                                "modelRowHide"=>"d-none",
                                "modelValue"=>"prospect",

                                "statusRowHide"=>"", 

                                "lastnameValue"=>$getGather['usLastname'],
                                "firstnameValue"=>$getGather['usFirstname'],
                                "addressValue"=>$getGather['usAddress'],
                                "postcodeValue"=>$getGather['usPostcode'],
                                "cityValue"=>$getGather['usCity'],                                
                                "commentField"=>$getGather['usComment'],

                                "buttonAction"=>"edit",
                                "buttonText"=>"Modifier");

        $this->pageSettings();  // lead to view/catview/CategoryView.php
        $this->prospClientFormSetup($formSettings); // leads to view/ProspectClientView.php
    }  



    /**
     * récupération des paramètres du formulaire de suppression
     * puis configuration de la page
     * puis envoie des paramêtres du formulaire
     * @access public
     * @param $getGather array prevonant de $_GET
     * appelée depuis le dispatch() case 'delete' de controller/ClientController 
     */   
    public function deleteFormSettings($getGather){
        $getGather = $this->htmlCharConvert($getGather); // leads to view/ViewInChief.php

        $formSettings = array(  "formTitle"=>"Suppression d'un prospect",
                                "readonly_inputs"=>"readonly",

                                "formAction"=>"index.php?controller=prospect",

                                "catIdRowHide"=>"d-none", 
                                "catIdValue"=>$getGather['catId'],

                                "usIdRowHide"=>"d-none",
                                "usIdValue"=>$getGather['usId'],

                                "modelRowHide"=>"d-none",
                                "modelValue"=>"prospect",

                                "statusRowHide"=>"d-none",  

                                "lastnameValue"=>$getGather['usLastname'],
                                "firstnameValue"=>$getGather['usFirstname'],
                                "addressValue"=>$getGather['usAddress'], 
                                "postcodeValue"=>$getGather['usPostcode'],
                                "cityValue"=>$getGather['usCity'],  
                                "commentField"=>$getGather['usComment'],

                                "buttonAction"=>"delete",
                                "buttonText"=>"Supprimer");
        $this->pageSettings(); // lead to view/catview/CategoryView.php
        $this->prospClientFormSetup($formSettings); // leads to view/ProspectClientView.php
    } 

}