<?php

namespace MVCExo\controller\prospect;

use MVCExo\Autoloader;

Autoloader::register();

abstract class ProspectCommonController
{
    protected object $prospectModel; // Objet de récuperation des données de la DB pour la table 'category'

    /** Si on init $prospectModel dans __construct, ça plante. L'init se passe trop tôt.
     * * Avec cette méthode on contourne le probléme.
     */
    protected function instanciateModel()
    {
        $this->prospectModel = new \MVCExo\model\ProspectModel();
    }
}
