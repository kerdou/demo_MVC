<?php

namespace MVCExo;

use MVCExo\Autoloader;

Autoloader::register();

    /** Fonction de dispatch qui lance tout le reste
     * * Récupération et analyse du contenu de $_GET['controller'] et $_GET['action']
     */
class Launcher extends GetAndPostCleaner
{
    private array $cleanedUpGet; // Recoit les données du $_GET une fois nettoyées
    private array $cleanedUpPost; // Recoit les données du $_POST une fois nettoyées
    private string $selectedController; // Recoit le nom du controleur qui est forcément inclut dans $_GET['controller']


    public function __construct()
    {
        // nettoyage des $_GET et $_POST avant envoi pour la suite
        $this->cleanedUpGet = (isset($_GET)) ? $this->inputCleaner($_GET) : array();
        $this->cleanedUpPost = (isset($_POST)) ? $this->inputCleaner($_POST) : array();

        // récupération du controleur voulu, si aucun n'est précisé on part sur 'home'
        $this->selectedController = (isset($this->cleanedUpGet['controller'])) ? $this->cleanedUpGet['controller'] : 'home';
        $this->launcher(); // lancement du launcher()
    }


    /** Lancement du controleur voulu, si aucun ne correspond on part sur HomeGetController
     * * Si $_POST est vide ça veut dire que le user vient de cliquer sur un lien de nav et que toutes les informations sont dans le $GET.
     * * Donc on part sur un GetController
     *
     * * Si $_POST n'est pas vide, ça veut dire que le user vient de submit un formulaire et que toutes les infos necessaires sont dans $_POST
     * * Donc on part sur un PostController
     */
    public function launcher()
    {
        if (empty($this->cleanedUpPost)) {
            switch ($this->selectedController) {
                case 'home':
                    $controllerObj = new \MVCExo\controller\HomeGetController();
                    $controllerObj->displayHomePage($this->cleanedUpGet);
                    break;

                case 'category':
                    $controllerObj = new \MVCExo\controller\category\CategoryGetController();
                    $controllerObj->actionReceiver($this->cleanedUpGet);
                    break;

                case 'prospect':
                    $controllerObj = new \MVCExo\controller\prospect\ProspectGetController();
                    $controllerObj->actionReceiver($this->cleanedUpGet);
                    break;

                case 'client':
                    $controllerObj = new \MVCExo\controller\client\ClientGetController();
                    $controllerObj->actionReceiver($this->cleanedUpGet);
                    break;

                default:
                    $controllerObj = new \MVCExo\controller\HomeGetController();
                    $controllerObj->displayHomePage($this->cleanedUpGet);
            }
        } else {
            switch ($this->selectedController) {
                case 'category':
                    $controllerObj = new \MVCExo\controller\category\CategoryPostController();
                    $controllerObj->actionReceiver($this->cleanedUpPost);
                    break;

                case 'prospect':
                    $controllerObj = new \MVCExo\controller\prospect\ProspectPostController();
                    $controllerObj->actionReceiver($this->cleanedUpPost);
                    break;

                case 'client':
                    $controllerObj = new \MVCExo\controller\client\ClientPostController();
                    $controllerObj->actionReceiver($this->cleanedUpPost);
                    break;

                default:
                    $controllerObj = new \MVCExo\controller\HomeGetController();
                    $controllerObj->displayHomePage($this->cleanedUpPost);
            }
        }
    }
}
