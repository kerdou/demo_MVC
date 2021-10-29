<?php

namespace MVCExo\model;

use MVCExo\Autoloader;

Autoloader::register();

/** Model de la section 'catégorie' */
class CategoryModel extends ModelInChief
{
    /** Récupération de toutes les lignes de la table category
     * @return $catTable array contenant les datas des catégories
     */
    public function selectAllCategories()
    {
        $stmt = 'SELECT * from category ORDER BY catName';
        $requestResult = $this->pdo->query($stmt);

        $catTable = array();

        if ($requestResult) {
            $catTable = $requestResult->fetchAll(\PDO::FETCH_ASSOC);
        }
        return $catTable;
    }

    /** Ajout d'une catégorie dans la table category
     * @param array $postGather qui contient les paramètres du $_POST
     */
    public function addCategory(array $postGather)
    {
        $stmt = 'INSERT INTO category VALUES (NULL, :catName , :catDescript)';
        $this->query = $this->pdo->prepare($stmt);
        $this->query->bindParam(':catName', $postGather['catName']);
        $this->query->bindParam(':catDescript', $postGather['catDescript']);
        $this->pdoQueryExecute();
    }

    /** Modification d'une catégorie dans la table category
     * @param array $postGather qui contient les paramètres du $_POST
     */
    public function editCategory(array $postGather)
    {
        $stmt = 'UPDATE category SET catName=:catName, catDescript=:catDescript WHERE catId=:catId';
        $this->query = $this->pdo->prepare($stmt);
        $this->query->bindParam(':catName', $postGather['catName']);
        $this->query->bindParam(':catDescript', $postGather['catDescript']);
        $this->query->bindParam(':catId', $postGather['catId']);
        $this->pdoQueryExecute();
    }

    /** Suppression d'une catégorie (catId) dans la table category
     * @param array $postGather qui contient les paramètres du $_POST
     */
    public function deleteCategory(array $postGather)
    {
        $stmt = 'DELETE FROM category WHERE catId=:catId';
        $this->query = $this->pdo->prepare($stmt);
        $this->query->bindParam(':catId', $postGather['catId']);
        $this->pdoQueryExecute();
    }
}
