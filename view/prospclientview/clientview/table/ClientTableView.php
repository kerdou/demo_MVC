<?php

require_once "view/prospclientview/clientview/ClientView.php";

/**
 * Classe fille de la ClientView dediée à la configuration du tableau 
 */
class ClientTableView extends ClientView {

    /**
     * récupération des paramètres du tableau
     * puis envoi de ces paramètres
     * @access public
     * appelée depuis le dispatch() case 'add' de controller/ClientController 
     */
    public function tableSettings() {
        $tableSettings = array(
                                "tableTitle"=> "Liste des clients",
                                "addLink"=>"index.php?controller=client&action=add",
                                "addLinkText"=>"Ajouter un client");
        $this->tableSetup($tableSettings); // leads to view/ViewInChief.php
    }



    /**
     * création de la <table> et de son contenu avec la boucle foreach
     * puis configuration de la page
     * puis configuration du tableau
     * puis affichage de la page
     * @access public
     * @param $TableData array inclut le contenu de la table à assigner à chaque ligne
     * appelée depuis le dispatch() case 'getTable' de controller/ClientController 
     */  
    public function tablePrepare($tableData){
        $this->pageContent .= file_get_contents('public/html/prospclient/table/prospclienttabletop.html');  // inclusion du haut du tableau des prospects/clients
  
        foreach($tableData as $row) {  
            
            $row = $this->htmlCharConvert($row); // leads to view/ViewInChief.php

            $this->pageContent .=                
                                '<tr>'.
                                    "<td class='overflow-auto'>$row[usLastname]</td>
                                    <td class='overflow-auto'>$row[usFirstname]</td>
                                    <td class='overflow-auto'>$row[usAddress]</td>
                                    <td class='overflow-auto'>$row[usPostcode]</td>
                                    <td class='overflow-auto'>$row[usCity]</td>
                                    <td class='overflow-auto'>$row[usComment]</td>
                                    <td class='text-center editdeleteicons'>
                                        <a class='text-white' href='index.php?controller=client&action=edit&catId=$row[catId]&usId=$row[usId]&usLastname=$row[usLastname]&usFirstname=$row[usFirstname]&usAddress=$row[usAddress]&usPostcode=$row[usPostcode]&usCity=$row[usCity]&usComment=$row[usComment]'>".
                                            '<i class="fas fa-edit fa-2x"></i>
                                        </a>
                                        <div class="iconspacer"></div>'.
                                        "<a href='index.php?controller=client&action=delete&catId=$row[catId]&usId=$row[usId]&usLastname=$row[usLastname]&usFirstname=$row[usFirstname]&usAddress=$row[usAddress]&usPostcode=$row[usPostcode]&usCity=$row[usCity]&usComment=$row[usComment]'>".
                                            '<i class="fas fa-trash fa-2x"></i>
                                        </a>
                                    </td>
                                </tr>';
                    
                }

        $this->pageContent .= file_get_contents('public/html/prospclient/table/prospclienttablebottom.html'); // inclusion du bas du tableau des prospects/clients      

        $this->pageSettings(); // leads to view/catview/CategoryView.php
        $this->tableSettings(); // leads to the current file.php
        $this->pageDisplay(); // leads to view/ViewInChief.php
    }
}