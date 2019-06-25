<?php

require_once "view/homeview/HomeView.php";

class HomeTableView extends HomeView{
 
    public function tablePrepare($tableData){
        $this->pageContent .= file_get_contents('public/html/home/table/homeclienttabletop.html'); 
        
        $clientTableData = $tableData[1];
        $prospTableData = $tableData[0];

        foreach($clientTableData as $row) {

            $row = $this->htmlCharConvert($row);

            $this->pageContent .=                
                                '<tr>'.
                                    "<td class='overflow-auto'>$row[usLastname]</td>
                                    <td class='overflow-auto'>$row[usFirstname]</td>
                                    <td class='overflow-auto'>$row[usAddress]</td>
                                    <td class='overflow-auto'>$row[usPostcode]</td>
                                    <td class='overflow-auto'>$row[usCity]</td>
                                    <td class='overflow-auto'>$row[usComment]</td>
                                    <td class='editdeleteicons'></td>".
                                '</tr>';                    
                }
       
        $this->pageContent .= file_get_contents('public/html/home/table/hometablebottom.html');       

        $this->pageContent .= file_get_contents('public/html/home/table/homeprospecttabletop.html');

        foreach($prospTableData as $row) {

            $row = $this->htmlCharConvert($row);

            $this->pageContent .=                
                                '<tr>'.
                                    "<td class='overflow-auto'>$row[usLastname]</td>
                                    <td class='overflow-auto'>$row[usFirstname]</td>
                                    <td class='overflow-auto'>$row[usAddress]</td>
                                    <td class='overflow-auto'>$row[usPostcode]</td>
                                    <td class='overflow-auto'>$row[usCity]</td>
                                    <td class='overflow-auto'>$row[usComment]</td>
                                    <td class='editdeleteicons'></td>".
                                '</tr>';                    
                }        
        $this->pageContent .= file_get_contents('public/html/home/table/hometablebottom.html');

        $this->pageSettings();
        $this->pageDisplay();
    }
}