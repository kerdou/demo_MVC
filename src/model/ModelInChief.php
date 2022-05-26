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
        require_once "dbSettings.php"; // fichier de configuration de la connexion à la DB

        $hostmode = 'dev';

        // utilise les identifiants de cnx au serveur SQL suivant le mode choisi
        switch ($hostmode) {
            case 'dev':
                $host = DEVHOST;
                $base = DEVBASE;
                $user = DEVUSER;
                $password = DEVPASSWORD;
                break;
            case 'prod':
                $host = PRODHOST;
                $base = PRODBASE;
                $user = PRODUSER;
                $password = PRODPASSWORD;
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
            echo 'Error : ' . $e->getMessage();
            throw $e; // permet d'arrêter le script et d'ajouter l'erreur dans les logs Apache (merci Reno!)
        }
        $this->pdo->exec("SET CHARACTER SET utf8");
    }


    /** Envoi de la requete à la BDD puis fermeture de la connexion après qu'elle ait réussi, sinon renvoi d'une exception */
    protected function pdoQueryExecute()
    {
        try {
            $this->query->execute();
        } catch (\Exception $e) {
            echo 'Error : ' . $e->getMessage();
            throw $e; // permet d'arrêter le script et d'ajouter l'erreur dans les logs Apache (merci Reno!)
        }

        $this->query->closeCursor();
    }
}
