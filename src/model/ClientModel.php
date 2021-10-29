<?php

namespace MVCExo\model;

use MVCExo\Autoloader;

Autoloader::register();

/** Model de la section 'client' */
class ClientModel extends ModelInChief
{
    /** Récupération de tous les clients (catId=2) de la table user classé par ordre de usLastname
     * @return array $clientTable
     */
    public function selectAllClients()
    {
        $stmt = 'SELECT * from user WHERE catId=2 ORDER BY usLastname';
        $requestResult = $this->pdo->query($stmt);

        $clientTable = array();
        if ($requestResult) {
            $clientTable = $requestResult->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $clientTable;
    }

    /** Ajout d'un client dans la table user
     * @param array $postGather Contient les paramètres du $_POST
     */
    public function addClient(array $postGather)
    {
        $stmt = 'INSERT INTO user VALUES (NULL, :usFirstname, :usLastname, :usAddress, :usPostcode, :usCity, :usComment, "2", NOW())';
        $this->query = $this->pdo->prepare($stmt);
        $this->query->bindParam(':usFirstname', $postGather['usFirstname']);
        $this->query->bindParam(':usLastname', $postGather['usLastname']);
        $this->query->bindParam(':usAddress', $postGather['usAddress']);
        $this->query->bindParam(':usPostcode', $postGather['usPostcode']);
        $this->query->bindParam(':usCity', $postGather['usCity']);
        $this->query->bindParam(':usComment', $postGather['usComment']);
        $this->pdoQueryExecute(); // leads to model/ModelInChief.php
    }

    /** Modification d'un client (usId) dans la table user
     * @param array $postGather Contient les paramètres du $_POST
     */
    public function editClient(array $postGather)
    {
        $stmt = 'UPDATE user SET usFirstname=:usFirstname, usLastname=:usLastname, usAddress=:usAddress, usPostcode=:usPostcode, usCity=:usCity, usComment=:usComment, usModifTime=NOW() WHERE usId=:usId';
        $this->query = $this->pdo->prepare($stmt);
        $this->query->bindParam(':usId', $postGather['usId']);
        $this->query->bindParam(':usFirstname', $postGather['usFirstname']);
        $this->query->bindParam(':usLastname', $postGather['usLastname']);
        $this->query->bindParam(':usAddress', $postGather['usAddress']);
        $this->query->bindParam(':usPostcode', $postGather['usPostcode']);
        $this->query->bindParam(':usCity', $postGather['usCity']);
        $this->query->bindParam(':usComment', $postGather['usComment']);
        $this->pdoQueryExecute(); // leads to model/ModelInChief.php
    }



    /** Suppression d'un client (usId) dans la table user
     * @param array $postGather Contient les paramètres du $_POST
     */
    public function deleteClient(array $postGather)
    {
        $stmt = 'DELETE FROM user WHERE usId=:usId';
        $this->query = $this->pdo->prepare($stmt);
        $this->query->bindParam(':usId', $postGather['usId']);
        $this->pdoQueryExecute(); // leads to model/ModelInChief.php
    }
}
