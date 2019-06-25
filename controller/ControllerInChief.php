<?php

require_once "model/CategoryModel.php";

/**
 * Classe mère des controleurs
 * 
 * Classes filles directes:
 * HomeController
 * CategoryController
 * ProspectController
 * ClientController
 */

class ControllerInChief {

    /**
     * Fonction de vérification des codes postaux et des noms de ville pour ProspectController et  ClientController
     * @access protected
     * @return array renvoi les booléens de $postcodeChecks et $cityChecks (dans cet ordre)
     */
    protected function prospClientFormChecks(){        

        $usPostcode = $_POST['usPostcode']; //@var string récupére la valeur de $_POST['usPostcode']
        $usCity = $_POST['usCity']; //@var string récupére la valeur de $_POST['usCity']

        $postcodeChecks = false; //@var bool renverra le résultat du test du code postal
        $cityChecks = false; //@var bool renverra le résultat du test du nom de ville

        $pregListForCity = '/[\\/~`\!@#\$%\^&\*\(\)_\+=\{\}\[\]\|;:"\<\>,\.\?\\\]|[0-9]/'; // @var string expression régulière des caractères interdits pour les tests

        //si le code postal ne contient pas uniquement des chiffres un message apparaitra et la création du nouveau fournisseur sera empechée 
        $postCodeCheckNoMinus = strpos($usPostcode, "-");
        if((!is_numeric($usPostcode))||(is_numeric($postCodeCheckNoMinus))){
            $postcodeChecks = false;
        } else {
            $postcodeChecks = true;
        }

        //si le nom de la ville contient un caractére spécial interdit ou un chiifre un message apparaitra et la création du nouveau fournisseur sera empechée
        if(preg_match($pregListForCity, $usCity)){
            $cityChecks = false;
        } else {
            $cityChecks = true;
        }

        // @var string variable JS pour récupérer les messages d'erreurs de $postcodeChecks et $cityChecks
        echo '<script language="javascript">var alertMessage = ""</script>';

        if (!$postcodeChecks) {
            echo '<script language="javascript">alertMessage += "Le code postal ne doit comporter que des chiffres\n"</script>';
        }
            
        if (!$cityChecks) {
            echo '<script language="javascript">alertMessage += "Le nom de la ville ne doit comporter aucun chiffre ou caractére spécial"</script>';
        }

        // si le code postal OU le nom de la ville sont false alors le message d'erreur est complet et prés à être affiché, sinon il reste vide.
        if (!$postcodeChecks || !$cityChecks) {
            $errorMessage = '<script language="javascript">alert(alertMessage);</script>';
        } elseif ($postcodeChecks && $cityChecks) {
            $errorMessage = '';
        }

        return $errorMessage;
    }
}