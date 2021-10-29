<?php

namespace MVCExo;

final class Autoloader
{
    /** Enregistrement automatique des classes et chargement via autoload() */
    public static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /** Chargement des classes après avoir supprimé le vendor MVCExo */
    private static function autoload($classeName)
    {
        $classeName = str_replace('MVCExo\\', '', $classeName);
        require_once $classeName . '.php';
    }
}
