<?php

namespace MVCExo\controller\formsChecks;

use MVCExo\Autoloader;

Autoloader::register();

class CatFormsChecks
{
    /** Fonction de vérification des champs pour CategoryController
     * @return string renvoi le message d'erreur des contrôles
     */
    public function catFormInputChecks(array $postContent)
    {
        $catName = html_entity_decode($postContent['catName']) ;
        $catDescript = html_entity_decode($postContent['catDescript']);

        $catNameChecks = false; //@var bool renverra le résultat du test du nom de catégorie
        $catDescriptChecks = false; //@var bool renverra le résultat du test du description

        // Regex du nom de la catégorie
        $nameBeginning = "^([a-zàáâäçèéêëìíîïñòóôöùúûü]+(( |'‘’)[a-zàáâäçèéêëìíîïñòóôöùúûü]+)*)+";
        // ^                                                                          Doit être situé au début de la phrase
        //  (                                                                  )+     Doit inclure au moins 1 des caractères situés dans la liste suivante
        //   [a-zàáâäçèéêëìíîïñòóôöùúûü]+(                                   )*       Doit commencer par au moins 1 des caractères de la liste, la suite n'est pas obligatoire
        //                                ( |'‘’)[a-zàáâäçèéêëìíîïñòóôöùúûü]+         Doit commencer par un espace ou un ' et suivi d'au moins 1 caractère de la liste

        $nameEnding = "([-]([a-zàáâäçèéêëìíîïñòóôöùúûü]+(( |'‘’)[a-zàáâäçèéêëìíîïñòóôöùúûü]+)*)+)*$";
        //                                                                            $   Doit être situé à la fin de la phrase
        // ([-]                                                                     )*    La présence d'une suite commencant par un tiret n'est pas obligatoire
        //     (                                                                  )+      Doit inclure au moins 1 des caractères de la liste suivante
        //      [a-zàáâäçèéêëìíîïñòóôöùúûü]+(                                   )*        Doit inclure au moins 1 caractère de la liste, la siute n'est pas obligatoire
        //                                   ( |'‘’)[a-zàáâäçèéêëìíîïñòóôöùúûü]+          Doit commencer par un espace ou un ' et suivi d'au moins 1 caractère de la liste

        $pregListForCatName = "/" . $nameBeginning . $nameEnding . "/i"; // i = insensible à la casse
        $catNameChecks = (preg_match($pregListForCatName, $catName) ? true : false); // test de conformité du nom de la catégorie, s'il est bon $catNameChecks devient true


        // Regex de la description de la catégorie
        $descrBeginning = "^([a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+(( |'‘’)[a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+)*)+";
        // ^                                                                                                  Doit être au début de la phrase
        //  (                                                                                          )+     Doit inclure au moins 1 des caractères situés dans la liste
        //   [a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+(                                               )*       Doit inclure au moins 1 des caractères de la liste, suivi de 0 ou plusieurs caractères ci-dessous
        //                                            ( |'‘’)[a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+         Doit commencer par un espace ou un ' et suivi d'au moins 1 caractère de la liste

        $descrEnding = "([-]([a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+(( |'‘’)[a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+)*)+)*$";
        //                                                                                                    $   Doit être situé à la fin de la phrase
        // (                                                                                                )*    Doit comporter 0 ou plusieurs éléments de la liste suivante
        //  [-](                                                                                          )+      Doit comporter au moins 1 tiret suivi de la liste suivante
        //      [a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+(                                               )*        Doit comporter au moins 1 des caractères listés suivi de 0 ou plusieurs caractéres de la liste suivante
        //                                               ( |'‘’)[a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+          Doit commencer par un espace ou un ' suivi d'au moins 1 caractère de la liste suivante

        if (!empty($catDescript)) { // test de conformité de la description se déclenchant uniquement si la description n'est pas vide
            $pregListForCatDescript = "/" . $descrBeginning . $descrEnding . "/i"; // i = insensible à la casse

            if (preg_match($pregListForCatDescript, $catDescript)) {
                // si le test est bon $catDescriptChecks devient true.
                $catDescriptChecks = true;
            } else {
                $catDescriptChecks = false;
            }
        } else { // si la description est vide $catDescriptChecks devient quand même bon
            $catDescriptChecks = true;
        }



        // @var string variable JS pour récupérer les messages d'erreurs de tests au-dessus
        echo '<script language="javascript">var alertMessage = ""</script>';
        $somethingWentWrong = false;

        if (!$catNameChecks) {
            echo '<script language="javascript">alertMessage += "Le nom de la catégorie ne doit comporter aucun chiffre ou caractére spécial\n"</script>';
            $somethingWentWrong = true;
        }

        if (!$catDescriptChecks) {
            echo '<script language="javascript">alertMessage += "La description ne doit comporter aucun caractére spécial en dehors de ( ) : ? ! \n"</script>';
            $somethingWentWrong = true;
        }

        // si un des tests de conformité est false alors le message d'erreur s'affiche, sinon il reste vide.
        if ($somethingWentWrong) {
            $errorMessage = '<script language="javascript">alert(alertMessage);</script>';
        } else {
            $errorMessage = '';
        }

        return $errorMessage; // leads to getTableActionFromGet() in CategoryController.php
    }
}
