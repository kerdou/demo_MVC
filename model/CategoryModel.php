<?php

require_once "model/ModelInChief.php";

/**
 * Model de la section 'catégorie'
 * 
 * Fille de la classe 'ModelInChief' située dans le même repertoire.
 */
class CategoryModel extends ModelInChief {

    /**
     * récupération de toutes les lignes de la table category
     * @access public
     * @return $catTable array qui est un tableau associatif
     * appelé par dispatch() de controller/CategoryController.php
     */
    public function catTableGet() {
        $this->request = 'SELECT * from category ORDER BY catName';
        $requestResult = $this->dbConnect->query($this->request);

        $catTable = array();
        if ($requestResult){
            $catTable = $requestResult->fetchAll(PDO::FETCH_ASSOC);
        }
        return $catTable;
    }



    /**
     * ajout d'une catégorie dans la table category
     * @access public
     * @param $postGather qui contient les paramètres du $_POST
     * appelé par dispatch() de controller/CategoryController.php
     */   
    public function add($postGather) {
        $this->request = 'INSERT INTO category VALUES (NULL, :catName , :catDescript)';
        $this->request = $this->dbConnect->prepare($this->request);
        $this->request->bindParam(':catName', $postGather['catName']);
        $this->request->bindParam(':catDescript', $postGather['catDescript']);
        $this->executeTryCatch();        
    }



    /**
     * modification d'une catégorie dans la table category
     * @access public
     * @param $postGather qui contient les paramètres du $_POST
     * appelé par dispatch() de controller/CategoryController.php
     */    
    public function edit($postGather) {
        $this->request = 'UPDATE category SET catName=:catName, catDescript=:catDescript WHERE catId=:catId';
        $this->request = $this->dbConnect->prepare($this->request);
        $this->request->bindParam(':catName', $postGather['catName']);
        $this->request->bindParam(':catDescript', $postGather['catDescript']);
        $this->request->bindParam(':catId', $postGather['catId']);         
        $this->executeTryCatch();
    }



    /**
     * suppression d'une catégorie (catId) dans la table category
     * @access public
     * @param $postGather qui contient les paramètres du $_POST
     * appelé par dispatch() de controller/CategoryController.php
     */   
    public function delete($postGather) {
        $this->request = 'DELETE FROM category WHERE catId=:catId';
        $this->request = $this->dbConnect->prepare($this->request);
        $this->request->bindParam(':catId', $postGather['catId']);
        $this->executeTryCatch();
    }

}