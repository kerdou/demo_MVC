<?php

    require_once "controller/HomeController.php";
    require_once "controller/CategoryController.php";
    require_once "controller/ProspectController.php";
    require_once "controller/ClientController.php";

    dispatch();
    
    function dispatch() {
        /**
         * @var array contenu de $_GET['controller']
         * Si $GET['controller'] récuperer sa valeur, sinon le créer avec la valeur home pour éviter des messages d'erreur 
         */
        $controllerGet = (isset($_GET['controller']))? $_GET['controller'] : 'home';
        $controllerGet = $controllerGet.'Controller'; // ajout de 'Controller' pour appeler le vrai nom de la classe voulue

        /**
         * @var array contenu de $_GET['action']
         * Si $GET['action'] récuperer sa valeur, sinon le créer avec la valeur getTable pour éviter des messages d'erreur 
         */
        $actionGet = (isset($_GET['action']))? $_GET['action'] : 'getTable';
        $actionGet = $actionGet.'ActionFromGet'; // ajout de 'ActionFromGet' pour appeler le vrai nom de la fonction voulue

        /**
         * @var object création du controleur voulu puis appel de la fonction voulue
         * @example $currentController = new HomeController puis HomeController->getTableActionFromGet
         */        
        $currentController = new $controllerGet();        
        $currentController->$actionGet();
    }