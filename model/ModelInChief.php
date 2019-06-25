<?php

/**
 * Classe mère des models
 * 
 * Classes filles directes:
 * HomeModel
 * CategoryModel
 * ProspectModel
 * ClientModel
 */


class ModelInChief {

    /**
     * @var object PDO d'accès à la BDD
     * @access protected
     */
    protected $dbConnect;

    /**
     * @var array contient la requete à envoyer à la base, renvoi une exception en cas de problème
     * @access protected
     */
    protected $request;

    /**
     * construction automatique du PDO de connexion à la BDD, renvoi d'une exception en cas de problème
     * @access public
     * appelé depuis toutes les classes model filles
     */
    public function __construct(){ 
        require_once "model/dbSettings.php"; // fichier de configuration de la connexion à la DB

        try {
            $this->dbConnect = new PDO("mysql:host=".HOST.";dbname=".BASE,USER,PASSWORD);
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
        $this->dbConnect->exec("SET CHARACTER SET utf8");
    }


    /**
     * 
     * envoi de la requete à la BDD puis fermeture de la connexion après qu'elle ait réussi, sinon renvoi d'une exception
     * @access protected
     * appelé depuis toutes les classes model filles
     */
    protected function executeTryCatch() {
        try {
            $this->request->execute();
        } catch (Exception $e) {
            die ('Error : ' . $e->getMessage());
        }
    
        $this->request->closeCursor();
    }

}



