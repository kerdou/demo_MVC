<?php

namespace MVCExo;

use MVCExo\Autoloader;

Autoloader::register();

abstract class GetAndPostCleaner
{
    // Fonction nettoyant les données envoyées dans le $_GET et le $_POST
    protected function inputCleaner(array $inputData)
    {
        $cleanedUpArray = array();

        foreach ($inputData as $key => $value) {
            $value = trim($value); // pour supprimer les espaces avant et après la chaine
            $value = htmlspecialchars($value, ENT_QUOTES); // pour empecher le hacking en "convertissant" les caractéres spéciaux. Rend impossible l'utilisation de balises. Gére les ' et les " avec ENT_QUOTES
            $cleanedUpArray[$key] = $value;
        }

        return $cleanedUpArray;
    }
}
