<?php

namespace MVCExo\controller\client;

use MVCExo\Autoloader;

Autoloader::register();

/** Controleur de la section 'catégorie' */
class ClientPostController extends ClientCommonController
{
    private array $postContent = array(); // Données nettoyées provenants de $_POST

    /** Récupére [$_POST['action']], lance la modif de DB voulue puis lance l'affichage de la page necessaire
     * * Les header('location: DESTINATION') permettent de vider le $_POST pour éviter de renvoyer une commande du $_POST à cause d'un appui sur F5
     */
    public function actionReceiver(array $cleanedUpPost)
    {
        $this->postContent = $cleanedUpPost;
        $this->instanciateModel(); // instanciation du modéle

        if (isset($this->postContent['action'])) {
            switch ($this->postContent['action']) {
                case 'add':
                    $clientFormChecker = new \MVCExo\controller\formsChecks\ProspClientFormsChecks();
                    $checkErrorMessage = $clientFormChecker->prospClientFormChecks($this->postContent); // vérif de la conformité des données de $postContent

                    if (empty($checkErrorMessage)) {
                        $this->clientModel->addClient($this->postContent);
                        header('location: index.php?controller=client');
                    } else {
                        echo $checkErrorMessage;
                        header('refresh:0; url=index.php?controller=client');
                    }
                    break;

                case 'edit':
                    $clientFormChecker = new \MVCExo\controller\formsChecks\ProspClientFormsChecks();
                    $checkErrorMessage = $clientFormChecker->prospClientFormChecks($this->postContent); // vérif de la conformité des données de $postContent

                    if (empty($checkErrorMessage)) {
                        $this->clientModel->editClient($this->postContent);
                        header('location: index.php?controller=client');
                    } else {
                        echo $checkErrorMessage;
                        header('refresh:0; url=index.php?controller=client');
                    }
                    break;

                case 'delete':
                    if (empty($checkErrorMessage)) {
                        $this->clientModel->deleteClient($this->postContent);
                    }
                    header('location: index.php?controller=client');
                    break;

                default:
                    header('location: index.php?controller=client');
            }
        } else {
            header('location: index.php?controller=client');
        }
    }
}
