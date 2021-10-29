<?php

namespace MVCExo\controller\formsChecks;

use MVCExo\Autoloader;

Autoloader::register();

class ProspClientFormsChecks
{
    /** Fonction de vérification de tous les champs pour ProspectController et ClientController
     * @return string renvoi le message d'erreur des contrôles
     */
    public function prospClientFormChecks(array $postContent)
    {
        $usLastname = html_entity_decode($postContent['usLastname']);
        $usFirstname = html_entity_decode($postContent['usFirstname']);
        $usAddress = html_entity_decode($postContent['usAddress']);
        $usPostcode = html_entity_decode($postContent['usPostcode']);
        $usCity = html_entity_decode($postContent['usCity']);
        $usComment = html_entity_decode($postContent['usComment']);

        $lastnameChecks = false; //@var bool renverra le résultat du test du nom de famille
        $firstnameChecks = false; //@var bool renverra le résultat du test du prénom
        $addressChecks = false; //@var bool renverra le résultat du test de l'adresse
        $postcodeChecks = false; //@var bool renverra le résultat du test du code postal
        $cityChecks = false; //@var bool renverra le résultat du test du nom de ville
        $commentChecks = false; //@var bool renverra le résultat du test du commentaire

        // expressions régulières des caractères autorisés pour les tests
        // $pregListForAddress = "^([a-zàáâäçèéêëìíîïñòóôöùúûü0-9]+(( |')[a-zàáâäçèéêëìíîïñòóôöùúûü0-9]+)*)+([-]([a-zàáâäçèéêëìíîïñòóôöùúûü0-9]+(( |')[a-zàáâäçèéêëìíîïñòóôöùúûü0-9]+)*)+)*$";
        $addressBeginning = "^([a-zàáâäçèéêëìíîïñòóôöùúûü0-9]+(( |')[a-zàáâäçèéêëìíîïñòóôöùúûü0-9]+)*)+";
        // ^                                                                            Doit être situé au début de la phrase
        //  (                                                                      )+   Doit inclure au moins 1 des caractères situés dans la liste suivante
        //   [a-zàáâäçèéêëìíîïñòóôöùúûü0-9]+(                                    )*     Doit commencer par au moins 1 des caractères de la liste, la suite n'est pas obligatoire
        //                                   ( |')[a-zàáâäçèéêëìíîïñòóôöùúûü0-9]+       Doit commencer par un espace ou un ' et suivi d'au moins 1 caractère de la liste


        $addressEnding = "([-]([a-zàáâäçèéêëìíîïñòóôöùúûü0-9]+(( |')[a-zàáâäçèéêëìíîïñòóôöùúûü0-9]+)*)+)*$";
        //                                                                                $     Doit être situé à la fin de la phrase
        // (                                                                            )*      Doit comporter 0 ou plusieurs éléments de la liste suivante
        //  [-](                                                                      )+        Doit comporter au moins 1 tiret suivi de la liste suivante
        //      [a-zàáâäçèéêëìíîïñòóôöùúûü0-9]+(                                    )*          Doit comporter au moins 1 des caractères listés suivi de 0 ou plusieurs caractéres de la liste suivante
        //                                      ( |')[a-zàáâäçèéêëìíîïñòóôöùúûü0-9]+            Doit commencer par un espace ou un ' suivi d'au moins 1 caractère de la liste suivante

        $pregListForAddress = "/" . $addressBeginning . $addressEnding . "/i"; // i = insensible à la casse
        $addressChecks = (preg_match($pregListForAddress, $usAddress) ? true : false); // test de conformité de l'adresse, s'il est bon $addressChecks devient true


        //$pregListForNamesAndCity = "/^([a-zàáâäçèéêëìíîïñòóôöùúûü]+(( |')[a-zàáâäçèéêëìíîïñòóôöùúûü]+)*)+([-]([a-zàáâäçèéêëìíîïñòóôöùúûü]+(( |')[a-zàáâäçèéêëìíîïñòóôöùúûü]+)*)+)*$/i";
        $nameAndCityBeginning = "^([a-zàáâäçèéêëìíîïñòóôöùúûü]+(( |')[a-zàáâäçèéêëìíîïñòóôöùúûü]+)*)+";
        // ^                                                                        Doit être situé au début de la phrase
        //  (                                                                )+     Doit inclure au moins 1 des caractères situés dans la liste suivante
        //   [a-zàáâäçèéêëìíîïñòóôöùúûü]+(                                 )*       Doit commencer par au moins 1 des caractères de la liste, la suite n'est pas obligatoire
        //                                ( |')[a-zàáâäçèéêëìíîïñòóôöùúûü]+         Doit commencer par un espace ou un ' et suivi d'au moins 1 caractère de la liste

        $nameAndCityEnd = "([-]([a-zàáâäçèéêëìíîïñòóôöùúûü]+(( |')[a-zàáâäçèéêëìíîïñòóôöùúûü]+)*)+)*$";
        //                                                                          $   Doit être situé à la fin de la phrase
        // (                                                                      )*    Doit comporter 0 ou plusieurs éléments de la liste suivante
        //  [-](                                                                )+      Doit comporter au moins 1 tiret suivi de la liste suivante
        //      [a-zàáâäçèéêëìíîïñòóôöùúûü]+(                                 )*        Doit comporter au moins 1 des caractères listés suivi de 0 ou plusieurs caractéres de la liste suivante
        //                                   ( |')[a-zàáâäçèéêëìíîïñòóôöùúûü]+          Doit commencer par un espace ou un ' suivi d'au moins 1 caractère de la liste suivante

        $pregListForNamesAndCity = "/" . $nameAndCityBeginning . $nameAndCityEnd . "/i";
        $lastnameChecks = (preg_match($pregListForNamesAndCity, $usLastname) ? true : false); // test de conformité du nom de famille, s'il est bon $lastnameChecks devient true
        $firstnameChecks = (preg_match($pregListForNamesAndCity, $usFirstname) ? true : false); // test de conformité du prénom de famille, s'il est bon $firstnameChecks devient true
        $cityChecks = (preg_match($pregListForNamesAndCity, $usCity) ? true : false); // test de conformité du nom de la ville, s'il est bon $cityChecks devient true


        $pregListForPostCode = "/^[0-9]{5}$/"; // 5 chiffres entre 0 et 9
        $postcodeChecks = (preg_match($pregListForPostCode, $usPostcode) ? true : false); // test de conformité du code postal, s'il est bon $postcodeChecks devient true

        //$pregListForComment = "/^([a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+(( |')[a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+)*)+([-]([a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+(( |')[a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+)*)+)*$/i";
        $commentBeginning = "^([a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+(( |')[a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+)*)+";
        // ^                                                                                                Doit être situé au début de la phrase
        //  (                                                                                        )+     Doit inclure au moins 1 des caractères situés dans la liste suivante
        //   [a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+(                                             )*       Doit commencer par au moins 1 des caractères de la liste, la suite n'est pas obligatoire
        //                                            ( |')[a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+         Doit commencer par un espace ou un ' et suivi d'au moins 1 caractère de la liste

        $commentEnd = "([-]([a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+(( |')[a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+)*)+)*$";
        //                                                                                                  $   Doit être situé à la fin de la phrase
        // (                                                                                              )*    Doit comporter 0 ou plusieurs éléments de la liste suivante
        //  [-](                                                                                        )+      Doit comporter au moins 1 tiret suivi de la liste suivante
        //      [a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+(                                             )*        Doit comporter au moins 1 des caractères listés suivi de 0 ou plusieurs caractéres de la liste suivante
        //                                               ( |')[a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+          Doit commencer par un espace ou un ' suivi d'au moins 1 caractère de la liste suivante

        $pregListForComment = "/" . $commentBeginning . $commentEnd . "/i";
        if (!empty($usComment)) { // test de conformité du commentaire se déclenchant uniquement si le commentaire n'est pas vide
            if (preg_match($pregListForComment, $usComment)) { // si le test est bon $commentChecks devient true.
                $commentChecks = true;
            } else {
                $commentChecks = false;
            }
        } else { // si le commentaire est vide $commentChecks devient quand même bon
            $commentChecks = true;
        }



        // @var string variable JS pour récupérer les messages d'erreurs de tests au-dessus
        echo '<script language="javascript">var alertMessage = ""</script>';
        $somethingWentWrong = false;

        if (!$lastnameChecks) {
            echo '<script language="javascript">alertMessage += "Le nom de famille ne doit comporter aucun chiffre ou caractére spécial\n"</script>';
            $somethingWentWrong = true;
        }

        if (!$firstnameChecks) {
            echo '<script language="javascript">alertMessage += "Le prénom ne doit comporter aucun chiffre ou caractére spécial\n"</script>';
            $somethingWentWrong = true;
        }

        if (!$addressChecks) {
            echo '<script language="javascript">alertMessage += "L\'adresse ne doit comporter aucun caractére spécial\n"</script>';
            $somethingWentWrong = true;
        }

        if (!$postcodeChecks) {
            echo '<script language="javascript">alertMessage += "Le code postal ne doit comporter que des chiffres\n"</script>';
            $somethingWentWrong = true;
        }

        if (!$cityChecks) {
            echo '<script language="javascript">alertMessage += "Le nom de la ville ne doit comporter aucun chiffre ou caractére spécial\n"</script>';
            $somethingWentWrong = true;
        }

        if (!$commentChecks) {
            echo '<script language="javascript">alertMessage += "Le commentaire ne doit comporter aucun caractére spécial en dehors de ( ) : ? !  \n"</script>';
            $somethingWentWrong = true;
        }

        // si un des tests de conformité est false alors le message d'erreur s'affiche, sinon il reste vide.
        if ($somethingWentWrong) {
            $errorMessage = '<script language="javascript">alert(alertMessage);</script>';
        } else {
            $errorMessage = '';
        }

        return $errorMessage; // leads to getTableActionFromGet() in ClientController.php or ProspectController.php
    }
}
