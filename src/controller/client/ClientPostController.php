<?php

namespace MVCExo\controller\client;

use MVCExo\Autoloader;

Autoloader::register();

/** Controleur de la section 'catégorie' */
class ClientPostController extends ClientCommonController
{
    /** Récupére [$_POST['action']], lance la modif de DB voulue puis lance l'affichage de la page necessaire */
    public function actionReceiver(array $cleanedUpPost)
    {
        $this->instanciateModel(); // instanciation du modéle

        if (isset($cleanedUpPost['action'])) {
            switch ($cleanedUpPost['action']) {
                case 'add':
                    $clientFormChecker = new \MVCExo\controller\formsChecks\ProspClientFormsChecks();
                    $checkErrorMessage = $clientFormChecker->prospClientFormChecks($cleanedUpPost); // vérif de la conformité des données de $postContent

                    if (empty($checkErrorMessage)) {
                        $this->clientModel->addClient($cleanedUpPost);
                        echo "<script> window.location.replace('index.php?controller=client') </script>";
                    } else {
                        echo $checkErrorMessage;
                        echo "<script> window.location.replace('index.php?controller=client') </script>";
                    }
                    break;

                case 'edit':
                    $clientFormChecker = new \MVCExo\controller\formsChecks\ProspClientFormsChecks();
                    $checkErrorMessage = $clientFormChecker->prospClientFormChecks($cleanedUpPost); // vérif de la conformité des données de $postContent

                    if (empty($checkErrorMessage)) {
                        $this->clientModel->editClient($cleanedUpPost);
                        echo "<script> window.location.replace('index.php?controller=client') </script>";
                    } else {
                        echo $checkErrorMessage;
                        echo "<script> window.location.replace('index.php?controller=client') </script>";
                    }
                    break;

                case 'delete':
                    if (empty($checkErrorMessage)) {
                        $this->clientModel->deleteClient($cleanedUpPost);
                    }
                    echo "<script> window.location.replace('index.php?controller=client') </script>";
                    break;

                default:
                    echo "<script> window.location.replace('index.php?controller=client') </script>";
            }
        } else {
            echo "<script> window.location.replace('index.php?controller=client') </script>";
        }
    }
}
