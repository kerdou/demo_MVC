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
     * Fonction nettoyant les données envoyées dans le $_POST
     * @access protected
     * @return renvoi le contenu de $_POST nettoyé
     */
    protected function input_cleanup($data) {
        foreach($data as $key => $value) {
            $value = trim($value); // pour supprimer les espaces avant et après la chaine
            $value = stripslashes($value); // supprimer le \ avant un '
            $value = htmlspecialchars($value, ENT_QUOTES); // pour empecher le hacking en "convertissant" les caractéres spéciaux. Rend impossible l'utilisation de balises. Gére les ' et les " avec ENT_QUOTES
            $data[$key] = $value;                       
        }  
        return $data;
    }   

    /**
     * Fonction de vérification des champs pour CategoryController
     * @access protected
     * @return string renvoi le message d'erreur des contrôles
     */
    protected function categoryFormChecks(){        

        $catName = $_POST['catName']; 
        $catDescript = $_POST['catDescript'];

        $catNameChecks = false; //@var bool renverra le résultat du test du nom de catégorie
        $catDescriptChecks = false; //@var bool renverra le résultat du test du description


        // @var string expressions régulières des caractères autorisés pour les tests
        $pregListForCatName = "/^([a-zàáâäçèéêëìíîïñòóôöùúûü]+(( |')[a-zàáâäçèéêëìíîïñòóôöùúûü]+)*)+([-]([a-zàáâäçèéêëìíîïñòóôöùúûü]+(( |')[a-zàáâäçèéêëìíîïñòóôöùúûü]+)*)+)*$/i";
        $pregListForCatDescript = "/^([a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+(( |')[a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+)*)+([-]([a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+(( |')[a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+)*)+)*$/i";

        // test de conformité du nom de la catégorie, s'il est bon $catNameChecks devient true
        if(preg_match($pregListForCatName, $catName)){
            $catNameChecks = true;
        } else {
            $catNameChecks = false;
        }

        // test de conformité de la description se déclenchant uniquement si la description n'est pas vide, s'il est bon $catDescriptChecks devient true.
        // si la description est vide $catDescriptChecks devient quand même bon
        if (!empty($catDescript)) {
            if(preg_match($pregListForCatDescript, $catDescript)){
                $catDescriptChecks = true;
            } else {
                $catDescriptChecks = false;
            } 
        } else {
            $catDescriptChecks = true;
        }


        // @var string variable JS pour récupérer les messages d'erreurs de tests au-dessus
        echo '<script language="javascript">var alertMessage = ""</script>';

        if (!$catNameChecks) {
            echo '<script language="javascript">alertMessage += "Le nom de la catégorie ne doit comporter aucun chiffre ou caractére spécial\n"</script>';
        }

        if (!$catDescriptChecks) {
            echo '<script language="javascript">alertMessage += "La description ne doit comporter aucun caractére spécial en dehors de ( ) : ? ! \n"</script>';
        }
        
        // si un des tests de conformité est false alors le message d'erreur s'affiche, sinon il reste vide.
        if (!$catNameChecks || !$catDescriptChecks) {
            $errorMessage = '<script language="javascript">alert(alertMessage);</script>';
        } else  { 
            $errorMessage = '';
        }

        return $errorMessage; // leads to getTableActionFromGet() in CategoryController.php
    }




    /**
     * Fonction de vérification de tous les champs pour ProspectController et  ClientController
     * @access protected
     * @return string renvoi le message d'erreur des contrôles
     */
    protected function prospClientFormChecks(){        

        $usLastname = $_POST['usLastname']; 
        $usFirstname = $_POST['usFirstname'];
        $usAddress = $_POST['usAddress']; 
        $usPostcode = $_POST['usPostcode']; 
        $usCity = $_POST['usCity']; 
        $usComment = $_POST['usComment']; 

        $lastnameChecks = false; //@var bool renverra le résultat du test du nom de famille
        $firstnameChecks = false; //@var bool renverra le résultat du test du prénom
        $addressChecks = false; //@var bool renverra le résultat du test de l'adresse     
        $postcodeChecks = false; //@var bool renverra le résultat du test du code postal
        $cityChecks = false; //@var bool renverra le résultat du test du nom de ville
        $commentChecks = false; //@var bool renverra le résultat du test du commentaire


        // @var string expressions régulières des caractères autorisés pour les tests
        $pregListForAddress = "/^([a-zàáâäçèéêëìíîïñòóôöùúûü0-9]+(( |')[a-zàáâäçèéêëìíîïñòóôöùúûü0-9]+)*)+([-]([a-zàáâäçèéêëìíîïñòóôöùúûü0-9]+(( |')[a-zàáâäçèéêëìíîïñòóôöùúûü0-9]+)*)+)*$/i";
        $pregListForNamesAndCity = "/^([a-zàáâäçèéêëìíîïñòóôöùúûü]+(( |')[a-zàáâäçèéêëìíîïñòóôöùúûü]+)*)+([-]([a-zàáâäçèéêëìíîïñòóôöùúûü]+(( |')[a-zàáâäçèéêëìíîïñòóôöùúûü]+)*)+)*$/i";
        $pregListForPostCode = "/^[0-9]{5}$/";
        $pregListForComment = "/^([a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+(( |')[a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+)*)+([-]([a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+(( |')[a-zàáâäçèéêëìíîïñòóôöùúûü0-9:\(\)\?\!]+)*)+)*$/i";

        // test de conformité du nom de famille, s'il est bon $lastnameChecks devient true
        if(preg_match($pregListForNamesAndCity, $usLastname)){
            $lastnameChecks = true;
        } else {
            $lastnameChecks = false;
        }

        // test de conformité du prénom de famille, s'il est bon $firstnameChecks devient true
        if(preg_match($pregListForNamesAndCity, $usFirstname)){
            $firstnameChecks = true;
        } else {
            $firstnameChecks = false;
        }        

        // test de conformité de l'adresse, s'il est bon $addressChecks devient true
        if(preg_match($pregListForAddress, $usAddress)){
            $addressChecks = true;
        } else {
            $addressChecks = false;
        }    
        
        // test de conformité du code postal, s'il est bon $postcodeChecks devient true
        if(preg_match($pregListForPostCode, $usPostcode)){
            $postcodeChecks = true;
        } else {
            $postcodeChecks = false;
        }

        // test de conformité du nom de la ville, s'il est bon $cityChecks devient true
        if(preg_match($pregListForNamesAndCity, $usCity)){
            $cityChecks = true;
        } else {
            $cityChecks = false;
        }

        // test de conformité du commentaire se déclenchant uniquement si le commentaire n'est pas vide, s'il est bon $commentChecks devient true.
        // si le commentaire est vide $commentChecks devient quand même bon
        if (!empty($usComment)) {
            if(preg_match($pregListForComment, $usComment)){
                $commentChecks = true;
            } else {
                $commentChecks = false;
            } 
        } else {
            $commentChecks = true;
        }


        // @var string variable JS pour récupérer les messages d'erreurs de tests au-dessus
        echo '<script language="javascript">var alertMessage = ""</script>';

        if (!$lastnameChecks) {
            echo '<script language="javascript">alertMessage += "Le nom de famille ne doit comporter aucun chiffre ou caractére spécial\n"</script>';
        }

        if (!$firstnameChecks) {
            echo '<script language="javascript">alertMessage += "Le prénom ne doit comporter aucun chiffre ou caractére spécial\n"</script>';
        }

        if (!$addressChecks) {
            echo '<script language="javascript">alertMessage += "L\'adresse ne doit comporter aucun caractére spécial\n"</script>';
        }
        
        if (!$postcodeChecks) {
            echo '<script language="javascript">alertMessage += "Le code postal ne doit comporter que des chiffres\n"</script>';
        }
            
        if (!$cityChecks) {
            echo '<script language="javascript">alertMessage += "Le nom de la ville ne doit comporter aucun chiffre ou caractére spécial\n"</script>';
        }

        if (!$commentChecks) {
            echo '<script language="javascript">alertMessage += "Le commentaire ne doit comporter aucun caractére spécial en dehors de ( ) : ? !  \n"</script>';
        }
        
        // si un des tests de conformité est false alors le message d'erreur s'affiche, sinon il reste vide.
        if (!$lastnameChecks || !$firstnameChecks || !$addressChecks || !$postcodeChecks || !$cityChecks || !$commentChecks) {
            $errorMessage = '<script language="javascript">alert(alertMessage);</script>';
        } else  { 
            $errorMessage = '';
        }

        return $errorMessage; // leads to getTableActionFromGet() in ClientController.php or ProspectController.php
    }

    


}