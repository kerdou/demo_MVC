<?php

namespace MVCExo\model;

use MVCExo\Autoloader;

Autoloader::register();

abstract class ModelInChief
{
    protected object $pdo; // PDO d'accès à la BDD
    protected object $query; // Contient la requete à envoyer à la base, renvoi une exception en cas de problème


    /** Construction du PDO */
    public function __construct()
    {
        require_once "model/dbSettings.php"; // fichier de configuration de la connexion à la DB

        if (PHP_OS != 'WINNT') { // si l'OS est Windows, on est local
            $host = REMHOST;
            $base = REMBASE;
            $user = REMUSER;
            $password = REMPASSWORD;
        } else { // sinon c'est un host externe sous Linux
            $host = LOCHOST;
            $base = LOCBASE;
            $user = LOCUSER;
            $password = LOCPASSWORD;
        }

        $this->pdoInit($host, $base, $user, $password);
    }


    /** Construction du PDO
     * @param string $host      Adresse de l'hôte
     * @param string $base      Nom de la DB
     * @param string $user      Login de cnx au serveur SQL
     * @param string $password  Mot de passe
     */
    protected function pdoInit($host, $base, $user, $password)
    {
        try {
            $this->pdo = new \PDO(
                "mysql:host=" .
                $host . ";" .
                "dbname=" .
                $base,
                $user,
                $password
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
