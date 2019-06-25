<?php

require_once "view/ViewInChief.php";

/**
 * Classe mère de la section ProspectClientView et classe fille de ViewInChief
 * 
 * Classes filles directes:
 * view/prospclientview/clientview/ClientView
 * view/prospclientview/prospview/ProspView
 */
class ProspectClientView extends ViewInChief {

    /**
     * configure le titre du formulaire de client ou de prospect, tout ses paramètres et tout ses champs
     * puis affichage de la page
     * @access protected
     * @param $formSettings array contenant le paramêtrage du tableau.
     * appelé depuis les classes filles suivantes:
     * view/prospclientview/clientview/form/ClientFormView
     * view/prospclientview/prospview/form/ProspectFormView
     */
    protected function prospClientFormSetup($formSettings) {
        $this->pageContent .= file_get_contents('public/html/prospclient/form/prospclientform.html');  // inclut le template du formulaire prospect/client     
        
        $this->pageContent = str_replace("{formTitle}",         $formSettings["formTitle"],         $this->pageContent);
        $this->pageContent = str_replace("{readonly_inputs}",   $formSettings["readonly_inputs"],   $this->pageContent);

        $this->pageContent = str_replace("{formAction}",        $formSettings["formAction"],        $this->pageContent);         

        $this->pageContent = str_replace("{catIdRowHide}",      $formSettings["catIdRowHide"],      $this->pageContent);     
        $this->pageContent = str_replace("{catIdValue}",        $formSettings["catIdValue"],        $this->pageContent);     

        $this->pageContent = str_replace("{usIdRowHide}",       $formSettings["usIdRowHide"],       $this->pageContent);      
        $this->pageContent = str_replace("{usIdValue}",         $formSettings["usIdValue"],         $this->pageContent);          
        
        $this->pageContent = str_replace("{modelRowHide}",      $formSettings["modelRowHide"],      $this->pageContent);
        $this->pageContent = str_replace("{modelValue}",        $formSettings["modelValue"],        $this->pageContent);

        $this->pageContent = str_replace("{statusRowHide}",     $formSettings["statusRowHide"],     $this->pageContent);
       
        $this->pageContent = str_replace("{lastnameValue}",     $formSettings["lastnameValue"],     $this->pageContent);
        $this->pageContent = str_replace("{firstnameValue}",    $formSettings["firstnameValue"],    $this->pageContent);       
        $this->pageContent = str_replace("{addressValue}",      $formSettings["addressValue"],      $this->pageContent);       
        $this->pageContent = str_replace("{postcodeValue}",     $formSettings["postcodeValue"],     $this->pageContent);        
        $this->pageContent = str_replace("{cityValue}",         $formSettings["cityValue"],         $this->pageContent);        
        $this->pageContent = str_replace("{commentField}",      $formSettings["commentField"],      $this->pageContent);
        
        $this->pageContent = str_replace("{buttonAction}",      $formSettings["buttonAction"],      $this->pageContent);
        $this->pageContent = str_replace("{buttonText}",        $formSettings["buttonText"],        $this->pageContent);
        
        $this->pageDisplay(); // leads to view/ViewInChief.php
       }
}