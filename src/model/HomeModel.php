<?php

namespace MVCExo\model;

use MVCExo\Autoloader;

Autoloader::register();

/** Model de la section 'accueil' */
class HomeModel extends ModelInChief
{
    /** Double déclaration à la DB pour récupérer les 3 derniers clients et les 3 derniers prospects
     * @return array $dispatchedData Contenant les données client et prospect
     */
    public function selectThreeLastProspAndThreeLastClients()
    {
        // récupére les 3 derniers prospects (catId=1) et les tri par usModifTime
        $prospStmt = 'SELECT * FROM user WHERE catId = 1 ORDER BY usModifTime DESC LIMIT 3;';

        // récupére les 3 derniers clients (catId=2) et les tri par usModifTime
        $clientStmt = 'SELECT * from user WHERE catId = 2 ORDER BY usModifTime DESC LIMIT 3;';

        $prospClientStmt = $prospStmt . $clientStmt;
        $prospClientResult = $this->pdo->query($prospClientStmt);

        $stmtQty = substr_count($prospClientStmt, ';'); // Comptage du nombre de déclarations
        $dataSubject = ['prosp', 'client']; // clés qui seront insérées dans l'array $dispatchedData
        $dispatchedData = array(); // array recevant les données triées

        // tri et copie des résultats de la requete dans $dispatchedData
        for ($i = 0; $i < $stmtQty; $i++) {
            $dispatchedData[$dataSubject[$i]] = $prospClientResult->fetchAll(\PDO::FETCH_ASSOC);
            $prospClientResult->nextRowset(); // permet de passer à la requete suivante
        }

        return $dispatchedData;
    }
}
