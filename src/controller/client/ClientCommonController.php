<?php

namespace MVCExo\controller\client;

use MVCExo\Autoloader;

Autoloader::register();

abstract class ClientCommonController
{
    protected object $clientModel; // Objet de récuperation des données de la DB pour la table 'category'

    /** Si on init $categoryModel dans __construct, ça plante. L'init se passe trop tôt.
     * * Avec cette méthode on contourne le probléme.
     */
    protected function instanciateModel()
    {
        $this->clientModel = new \MVCExo\model\ClientModel();
    }
}
