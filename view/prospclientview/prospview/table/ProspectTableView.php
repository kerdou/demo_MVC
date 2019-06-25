<?php

require_once "view/prospclientview/prospview/ProspectView.php";

/**
 * Classe fille de la CategoryView dediée à la configuration du tableau 
 */
class ProspectTableView extends ProspectView {

    /**
     * récupération des paramètres du tableau
     * puis envoi de ces paramètres
     * @access public
     * appelée depuis le dispatch() case 'add' de controller/CategoryController 
     */
    public function tableSettings() {
        $tableSettings = array(
                                "tableTitle"=> "Liste des prospects",
                                "addLink"=>"index.php?controller=prospect&action=add",
                                "addLinkText"=>"Ajouter un prospect");
        $this->tableSetup($tableSettings); // leads to view/ViewInChief.php
    }

    public function tablePrepare($tableData){
        $this->pageContent .= file_get_contents('public/html/prospclient/table/prospclienttabletop.html'); // inclusion du haut du tableau des prospects/clients     

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
                                        <a class='text-white' href='index.php?controller=prospect&action=edit&catId=$row[catId]&usId=$row[usId]&usLastname=$row[usLastname]&usFirstname=$row[usFirstname]&usAddress=$row[usAddress]&usPostcode=$row[usPostcode]&usCity=$row[usCity]&usComment=$row[usComment]'>".
                                            '<i class="fas fa-edit fa-2x"></i>
                                        </a>
                                        <div class="iconspacer"></div>'.
                                        "<a href='index.php?controller=prospect&action=delete&catId=$row[catId]&usId=$row[usId]&usLastname=$row[usLastname]&usFirstname=$row[usFirstname]&usAddress=$row[usAddress]&usPostcode=$row[usPostcode]&usCity=$row[usCity]&usComment=$row[usComment]'>".
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