<?php

namespace MVCExo\view;

use MVCExo\Autoloader;

Autoloader::register();

/** Classe en charge de l'affichage de la page d'accueil */
class TableBuilder extends ViewInChief
{
    /** Création des lignes des tableaux pour la home page
     * @param array $tableData contenu à inserer dans les tableaux
     * @return array Contient les lignes créées
     */
    public static function clientAndProspTableRowBuilder(array $tableData)
    {
        $rowArray = array();

        foreach ($tableData as $rowValue) {
            $row =
                '<tr>' .
                    "<td class='overflow-auto'>$rowValue[usLastname]</td>
                    <td class='overflow-auto'>$rowValue[usFirstname]</td>
                    <td class='overflow-auto'>$rowValue[usAddress]</td>
                    <td class='overflow-auto'>$rowValue[usPostcode]</td>
                    <td class='overflow-auto'>$rowValue[usCity]</td>
                    <td class='overflow-auto'>$rowValue[usComment]</td>
                    <td class='editdeleteicons'></td>" .
                '</tr>';

                array_push($rowArray, $row);
        }

        return $rowArray;
    }

    /** Création des lignes du tableau pour la page des catégories
     * @param array $tableData contenu à inserer dans les tableaux
     * @return array Contient les lignes créées
     */
    public static function categoryTableRowWithButtonsBuilder(array $tableData)
    {
        $rowArray = array();

        foreach ($tableData as $rowValue) {
            $row =
                '<tr>' .
                    "<td>$rowValue[catName]</td>" .
                    "<td>$rowValue[catDescript]</td>" .
                    '<td class="text-center editdeleteicons">' .
                        "<a class='text-white' href='index.php?controller=category&action=edit&catId=$rowValue[catId]&catName=$rowValue[catName]&catDescript=$rowValue[catDescript]'>" .
                            '<i class="fas fa-edit fa-2x"></i>
                        </a>
                        <div class="iconspacer"></div>' .
                        "<a href='index.php?controller=category&action=delete&catId=$rowValue[catId]&catName=$rowValue[catName]&catDescript=$rowValue[catDescript]'>" .
                            '<i class="fas fa-trash fa-2x"></i>
                        </a>
                    </td>
                </tr>';

                array_push($rowArray, $row);
        }

        return $rowArray;
    }


    /** Création des lignes des tableaux pour les pages de prospects et de clients
     * @param string $controller    Définit le type de controlleur à insérer dans les liens des boutons
     * @param array $tableData      Contenu à inserer dans les tableaux
     * @return array                Contient les lignes créées
     */
    public static function prospAndClientTableRowWithButtonsBuilder(string $controller, array $tableData)
    {
        $rowArray = array();

        foreach ($tableData as $rowValue) {
            $row =
                '<tr>' .
                    "<td>$rowValue[usLastname]</td>
                    <td>$rowValue[usFirstname]</td>
                    <td>$rowValue[usAddress]</td>
                    <td>$rowValue[usPostcode]</td>
                    <td>$rowValue[usCity]</td>
                    <td>$rowValue[usComment]</td>
                    <td class='text-center editdeleteicons'>
                        <a class='text-white' href='index.php?controller=$controller&action=edit&catId=$rowValue[catId]&usId=$rowValue[usId]&usLastname=$rowValue[usLastname]&usFirstname=$rowValue[usFirstname]&usAddress=$rowValue[usAddress]&usPostcode=$rowValue[usPostcode]&usCity=$rowValue[usCity]&usComment=$rowValue[usComment]'>" .
                            '<i class="fas fa-edit fa-2x"></i>
                        </a>
                        <div class="iconspacer"></div>' .
                        "<a href='index.php?controller=$controller&action=delete&catId=$rowValue[catId]&usId=$rowValue[usId]&usLastname=$rowValue[usLastname]&usFirstname=$rowValue[usFirstname]&usAddress=$rowValue[usAddress]&usPostcode=$rowValue[usPostcode]&usCity=$rowValue[usCity]&usComment=$rowValue[usComment]'>" .
                            '<i class="fas fa-trash fa-2x"></i>
                        </a>
                    </td>
                </tr>';

            array_push($rowArray, $row);
        }

        return $rowArray;
    }
}
