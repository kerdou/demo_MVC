<?php

require_once "view/ViewInChief.php";

/**
 * Classe mère de la section accueil et classe fille de ViewInChief
 * 
 * Classe fille directe:
 * view/homeview/tableHomeTableView 
 */
class HomeView extends ViewInChief{

    /**
     * liste des paramêtrages de la page d'accueil
     * @access protected
     * appelée par view/homeview/tableHomeTableView 
     */
    protected function pageSettings() {
        $pageSettings = array(  "pageTitle"=>"Your CRM - Accueil", 
                                "activeHome"=>"active", 
                                "activeCat"=>"", 
                                "activeProsp"=>"", 
                                "activeClient"=>"");
        $this->pageSetup($pageSettings); // leads to view/ViewInChief.php
    } 
}