<?php

require_once "view/ViewInChief.php";

/**
 * Classe mère de la section catégorie et classe fille de ViewInChief
 * 
 * Classes filles directes:
 * view/catview/form/CategoryFormView
 * view/catview/table/CategoryTableView
 */
class CategoryView  extends ViewInChief {

    /**
     * liste des paramêtrages de la section catégorie
     * @access protected
     * view/catview/form/CategoryFormView 
     * view/catview/table/CategoryTableView
     */
    protected function pageSettings() {
        $pageSettings = array(  "pageTitle"=>"Your CRM - Catégories", 
                                "activeHome"=>"", 
                                "activeCat"=>"active", 
                                "activeProsp"=>"", 
                                "activeClient"=>"");
        $this->pageSetup($pageSettings); //leads to view/ViewInChief.php
    } 
}