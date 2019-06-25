<?php

require_once "view/catview/CategoryView.php";

/**
 * Classe fille de la CategoryView dediée à la configuration du tableau 
 */
class CategoryTableView  extends CategoryView {

    /**
     * récupération des paramètres du tableau
     * puis envoi de ces paramètres
     * @access public
     * appelée depuis le dispatch() case 'add' de controller/CategoryController 
     */
    public function tableSettings() {
        $tableSettings = array(
                                "tableTitle"=> "Liste des catégories",
                                "addLink"=>"index.php?controller=category&action=add",
                                "addLinkText"=>"Ajouter une catégorie");
        $this->tableSetup($tableSettings); // leads to view/ViewInChief.php
    }



    /**
     * création de la <table> et de son contenu avec la boucle foreach
     * puis configuration de la page
     * puis configuration du tableau
     * puis affichage de la page
     * @access public
     * @param $catTableData array inclut le contenu de la table à assigner à chaque ligne
     * appelée depuis le dispatch() case 'getTable' de controller/CategoryController 
     */    
    public function catTablePrepare($catTableData) {
        $this->pageContent .= file_get_contents('public/html/category/table/cattabletop.html'); // inclusion du haut du tableau des catégories

        foreach($catTableData as $row) {
            $row = $this->htmlCharConvert($row); // leads to view/ViewInChief.php
            $this->pageContent .=                                    
                                    '<tr>'.
                                        "<td class='overflow-auto'>$row[catName]</td>".                        
                                        "<td class='overflow-auto'>$row[catDescript]</td>".
                                        '<td class="text-center editdeleteicons">'.
                                            "<a class='text-white' href='index.php?controller=category&action=edit&catId=$row[catId]&catName=$row[catName]&catDescript=$row[catDescript]'>".
                                                '<i class="fas fa-edit fa-2x"></i>
                                            </a>
                                            <div class="iconspacer"></div>'.
                                            "<a href='index.php?controller=category&action=delete&catId=$row[catId]&catName=$row[catName]&catDescript=$row[catDescript]'>".
                                                '<i class="fas fa-trash fa-2x"></i>
                                            </a>
                                        </td>
                                    </tr>';                                    
        }
 
        $this->pageContent .= file_get_contents('public/html/category/table/cattablebottom.html'); // inclusion du bas du tableau des catégories

        $this->pageSettings(); // leads to view/catview/CategoryView.php
        $this->tableSettings(); // leads to the current file.php
        $this->pageDisplay(); // leads to view/ViewInChief.php
    }
}