<?php

require_once "view/prospclientview/ProspectClientView.php";
/**
 * Classe mère de la section prospectView et classe fille de ProspectClientView
 * 
 * Classes filles directes:
 * view/prospclientview/prospview/form/ProspectFormView
 * view/prospclientview/prospview/table/ProspectTableView
 */
class ProspectView extends ProspectClientView {
    /**
     * liste des paramêtrages de la section prospect
     * @access protected
     * view/prospclientview/prospview/form/ProspectFormView
     * view/prospclientview/prospview/table/ProspectTableView
     */
    protected function pageSettings() {
        $pageSettings = array(  "pageTitle"=>"Your CRM - Prospects", 
                                "activeHome"=>"", 
                                "activeCat"=>"", 
                                "activeProsp"=>"active", 
                                "activeClient"=>"");
        $this->pageSetup($pageSettings); //leads to view/ViewInChief.php
    } 
}