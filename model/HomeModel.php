<?php

require_once "model/ModelInChief.php";

/**
 * Model de la section 'accueil'
 * 
 * Fille de la classe 'ModelInChief' située dans le même repertoire.
 */
class HomeModel extends ModelInChief {

    /**
     * double requete à la DB pour récupérer les 3 derniers clients et les 3 derniers prospects
     * @access public
     * @return tableau contenant $prospTable et $clientTable
     * appelé par dispatch() de controller/HomeController.php
     */
    public function homeTableGet() {
        // récupére les 3 derniers prospects (catId=1) et les tri par usModifTime
        $this->prospRequest = 'SELECT * FROM user WHERE catId = 1 ORDER BY usModifTime DESC LIMIT 3';
        $prospRequestResult = $this->dbConnect->query($this->prospRequest);
        
        // récupére les 3 derniers clients (catId=2) et les tri par usModifTime
        $this->clientRequest = 'SELECT * from user WHERE catId = 2 ORDER BY usModifTime DESC LIMIT 3';
        $clientRequestResult = $this->dbConnect->query($this->clientRequest);        

        $prospTable = array(); //@var array contient le tableau associatif des prospects 
        if ($prospRequestResult){
            $prospTable = $prospRequestResult->fetchAll(PDO::FETCH_ASSOC);
        }


        $clientTable = array(); //@var array contient le tableau associatif des clients
        if ($clientRequestResult){
            $clientTable = $clientRequestResult->fetchAll(PDO::FETCH_ASSOC);
        }
 
        return array($prospTable, $clientTable);
    }
}