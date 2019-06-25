<?php

require_once "view/prospclientview/clientview/ClientView.php";

/**
 * Classe fille de la ClientView dediée à la configuration de 
 * ses formulaires d'ajout, modification et suppression 
 */
class ClientFormView extends ClientView {
   
    /**
     * récupération des paramètres du formulaire d'ajout
     * puis configuration de la page
     * puis envoie des paramêtres du formulaire
     * @access public
     * appelée depuis le dispatch() case 'add' de controller/ClientController 
     */
    public function addFormSettings(){
        $formSettings = array(  "formTitle"=>"Ajout d'un client",
                                "readonly_inputs"=>"",

                                "formAction"=>"index.php?controller=client",

                                "catIdRowHide"=>"d-none",
                                "catIdValue"=>"",

                                "usIdRowHide"=>"d-none",
                                "usIdValue"=>"",

                                "modelRowHide"=>"d-none",
                                "modelValue"=>"client",                                

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
     * appelée depuis le dispatch() case 'edit' de controller/ClientController 
     */      
    public function editFormSettings($getGather){
        
        $getGather = $this->htmlCharConvert($getGather); // leads to view/ViewInChief.php

        $formSettings = array(  "formTitle"=>"Modification d'un client",
                                "readonly_inputs"=>"",

                                "formAction"=>"index.php?controller=client",

                                "catIdRowHide"=>"d-none",
                                "catIdValue"=>$getGather['catId'],

                                "usIdRowHide"=>"d-none",
                                "usIdValue"=>$getGather['usId'],

                                "modelRowHide"=>"d-none",
                                "modelValue"=>"client",

                                "statusRowHide"=>"d-none",

                                "lastnameValue"=>$getGather['usLastname'],
                                "firstnameValue"=>$getGather['usFirstname'],
                                "addressValue"=>$getGather['usAddress'],
                                "postcodeValue"=>$getGather['usPostcode'],
                                "cityValue"=>$getGather['usCity'],
                                "commentField"=>$getGather['usComment'],

                                "buttonAction"=>"edit",
                                "buttonText"=>"Modifier");

        $this->pageSettings(); // leads to view/catview/CategoryView.php
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

        $formSettings = array(  "formTitle"=>"Suppression d'un client",
                                "readonly_inputs"=>"readonly",

                                "formAction"=>"index.php?controller=client",

                                "catIdRowHide"=>"d-none",
                                "catIdValue"=>$getGather['catId'],

                                "usIdRowHide"=>"d-none",
                                "usIdValue"=>$getGather['usId'],

                                "modelRowHide"=>"d-none",
                                "modelValue"=>"client",

                                "statusRowHide"=>"d-none",

                                "lastnameValue"=>$getGather['usLastname'],
                                "firstnameValue"=>$getGather['usFirstname'],
                                "addressValue"=>$getGather['usAddress'],
                                "postcodeValue"=>$getGather['usPostcode'],
                                "cityValue"=>$getGather['usCity'],
                                "commentField"=>$getGather['usComment'],

                                "buttonAction"=>"delete",
                                "buttonText"=>"Supprimer");
        
        $this->pageSettings(); // leads to view/catview/CategoryView.php
        $this->prospClientFormSetup($formSettings); // leads to view/ProspectClientView.php
    } 

}