<?php

namespace MVCExo\model;

use MVCExo\Autoloader;

Autoloader::register();

abstract class ModelInChief extends DBSettings
{
    protected object $pdo; // PDO d'accès à la BDD
    protected object $query; // Contient la requete à envoyer à la base, renvoi une exception en cas de problème


    /**   */
    public function __construct()
    {
        try {
            $this->pdo = new \PDO(
                "mysql:host=" .
                DBSettings::HOST . ";" .
                "dbname=" .
                DBSettings::BASE,
                DBSettings::USER,
                DBSettings::PASSWORD
            );
        } catch (\Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
        $this->pdo->exec("SET CHARACTER SET utf8");
    }


    /** Envoi de la requete à la BDD puis fermeture de la connexion après qu'elle ait réussi, sinon renvoi d'une exception */
    protected function pdoQueryExecute()
    {
        try {
            $this->query->execute();
        } catch (\Exception $e) {
            die('Error : ' . $e->getMessage());
        }

        $this->query->closeCursor();
    }
}
