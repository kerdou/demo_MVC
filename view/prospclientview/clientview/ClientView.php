<?php

require_once "view/prospclientview/ProspectClientView.php";
/**
 * Classe mère de la section clientView et classe fille de ProspectClientView
 * 
 * Classes filles directes:
 * view/prospclientview/clientview/form/ClientFormView
 * view/prospclientview/clientview/table/ClientTableView
 */
class ClientView extends ProspectClientView {
    /**
     * liste des paramêtrages de la section client
     * @access protected
     * view/prospclientview/clientview/form/ClientFormView
     * view/prospclientview/clientview/table/ClientTableView
     */    
    protected function pageSettings() {
        $pageSettings = array(  "pageTitle"=>"Your CRM - Clients", 
                                "activeHome"=>"", 
                                "activeCat"=>"", 
                                "activeProsp"=>"", 
                                "activeClient"=>"active");
        $this->pageSetup($pageSettings); //leads to view/ViewInChief.php
    } 
}