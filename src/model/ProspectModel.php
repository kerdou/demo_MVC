<?php

namespace MVCExo\model;

use MVCExo\Autoloader;

Autoloader::register();

/** Model de la section 'prospect' */
class ProspectModel extends ModelInChief
{

    /** Récupération de tous les prospects (catId=1) de la table user classé par ordre de usLastname
     * @return array $prospTable Contient les datas prospects
     */
    public function selectAllProspects()
    {
        $stmt = 'SELECT * from user WHERE catId=1 ORDER BY usLastname';
        $requestResult = $this->pdo->query($stmt);

        $prospTable = array();
        if ($requestResult) {
            $prospTable = $requestResult->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $prospTable;
    }

    /** Ajout d'un prospect dans la table user
     * @param array $postGather qui contient les paramètres du $_POST
     */
    public function addProspect(array $postGather)
    {
        $stmt = 'INSERT INTO user VALUES (NULL, :usFirstname, :usLastname, :usAddress, :usPostcode, :usCity, :usComment, "1", NOW())';
        $this->query = $this->pdo->prepare($stmt);
        $this->query->bindParam(':usFirstname', $postGather['usFirstname']);
        $this->query->bindParam(':usLastname', $postGather['usLastname']);
        $this->query->bindParam(':usAddress', $postGather['usAddress']);
        $this->query->bindParam(':usPostcode', $postGather['usPostcode']);
        $this->query->bindParam(':usCity', $postGather['usCity']);
        $this->query->bindParam(':usComment', $postGather['usComment']);
        $this->pdoQueryExecute(); // leads to model/ModelInChief.php
    }

    /** Modification d'un prospect (usId) dans la table user
     * @param array $postGather qui contient les paramètres du $_POST
     */
    public function editProspect($postGather)
    {
        $stmt = 'UPDATE user SET usFirstname=:usFirstname, usLastname=:usLastname, usAddress=:usAddress, usPostcode=:usPostcode, usCity=:usCity, usComment=:usComment, catId=:catIdStatus, usModifTime=NOW() WHERE usId=:usId';
        $this->query = $this->pdo->prepare($stmt);
        $this->query->bindParam(':usId', $postGather['usId']);
        $this->query->bindParam(':usFirstname', $postGather['usFirstname']);
        $this->query->bindParam(':usLastname', $postGather['usLastname']);
        $this->query->bindParam(':usAddress', $postGather['usAddress']);
        $this->query->bindParam(':usPostcode', $postGather['usPostcode']);
        $this->query->bindParam(':usCity', $postGather['usCity']);
        $this->query->bindParam(':usComment', $postGather['usComment']);
        $this->query->bindParam(':catIdStatus', $postGather['catIdStatus']);
        $this->pdoQueryExecute(); // leads to model/ModelInChief.php
    }

    /** Suppression d'un prospect (usId) dans la table user
     * @param array $postGather qui contient les paramètres du $_POST
     */
    public function deleteProspect($postGather)
    {
        $stmt = 'DELETE FROM user WHERE usId=:usId';
        $this->query = $this->pdo->prepare($stmt);
        $this->query->bindParam(':usId', $postGather['usId']);
        $this->pdoQueryExecute(); // leads to model/ModelInChief.php
    }
}
