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
        $classeName = str_replace('MVCExo\\', '', $classeName); // supprime le namespace pour ne conserver que le chemin de la classe

        // les chemins sur Windows sont en Parent\Child, ceux sur Linux sont en Parent/Child
        // cette bidouille fait automatiquement l'adaptation
        if (PHP_OS != 'WINNT') {
            $classeName = str_replace('\\', '/', $classeName);
        }
        require_once $classeName . '.php';
    }
}
