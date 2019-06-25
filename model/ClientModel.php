<?php

require_once "model/ModelInChief.php";

/**
 * Model de la section 'client'
 * 
 * Fille de la classe 'ModelInChief' située dans le même repertoire.
 */
class ClientModel extends ModelInChief {

    /**
     * récupération de tous les clients (catId=2) de la table user classé par ordre de usLastname
     * @access public
     * @return $clientTable array qui est un tableau associatif
     * appelé par dispatch() controller/ClientController.php
     */
    public function getClientTable() {
        $this->request = 'SELECT * from user WHERE catId=2 ORDER BY usLastname';
        $requestResult = $this->dbConnect->query($this->request);

        $clientTable = array();
        if ($requestResult){
            $clientTable = $requestResult->fetchAll(PDO::FETCH_ASSOC);
        }
        return $clientTable;
    }



    /**
     * ajout d'un client dans la table user
     * @access public
     * @param $postGather qui contient les paramètres du $_POST
     * appelé par dispatch() de controller/ClientController.php
     */
    public function add($postGather) {
        $this->request = 'INSERT INTO user VALUES (NULL, :usFirstname, :usLastname, :usAddress, :usPostcode, :usCity, :usComment, "2", NOW())';
        $this->request = $this->dbConnect->prepare($this->request);
        $this->request->bindParam(':usFirstname', $postGather['usFirstname']);
        $this->request->bindParam(':usLastname', $postGather['usLastname']);
        $this->request->bindParam(':usAddress', $postGather['usAddress']);
        $this->request->bindParam(':usPostcode', $postGather['usPostcode']);
        $this->request->bindParam(':usCity', $postGather['usCity']);
        $this->request->bindParam(':usComment', $postGather['usComment']); 
        $this->executeTryCatch(); // leads to model/ModelInChief.php  
    }



    /**
     * modification d'un client (usId) dans la table user
     * @access public
     * @param $postGather qui contient les paramètres du $_POST
     * appelé par dispatch() de controller/ClientController.php
     */
    public function edit($postGather) {
        $this->request = 'UPDATE user SET usFirstname=:usFirstname, usLastname=:usLastname, usAddress=:usAddress, usPostcode=:usPostcode, usCity=:usCity, usComment=:usComment, usModifTime=NOW() WHERE usId=:usId';
        $this->request = $this->dbConnect->prepare($this->request);
        $this->request->bindParam(':usId',          $postGather['usId']);        
        $this->request->bindParam(':usFirstname',   $postGather['usFirstname']);
        $this->request->bindParam(':usLastname',    $postGather['usLastname']);
        $this->request->bindParam(':usAddress',     $postGather['usAddress']);
        $this->request->bindParam(':usPostcode',    $postGather['usPostcode']);
        $this->request->bindParam(':usCity',        $postGather['usCity']);
        $this->request->bindParam(':usComment',     $postGather['usComment']);         
        $this->executeTryCatch(); // leads to model/ModelInChief.php 
    }



    /**
     * suppression d'un client (usId) dans la table user
     * @access public
     * @param $postGather qui contient les paramètres du $_POST
     * appelé par dispatch() de controller/ClientController.php
     */    
    public function delete($postGather) {
        $this->request = 'DELETE FROM user WHERE usId=:usId';
        $this->request = $this->dbConnect->prepare($this->request);
        $this->request->bindParam(':usId', $postGather['usId']);
        $this->executeTryCatch(); // leads to model/ModelInChief.php 
    }
}