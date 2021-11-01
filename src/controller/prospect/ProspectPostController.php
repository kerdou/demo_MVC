<?php

namespace MVCExo\controller\prospect;

use MVCExo\Autoloader;

Autoloader::register();

/** Controleur de la section 'catégorie' */
class ProspectPostController extends ProspectCommonController
{
    /** Récupére [$_POST['action']], lance la modif de DB voulue puis lance l'affichage de la page necessaire */
    public function actionReceiver(array $cleanedUpPost)
    {
        $this->instanciateModel(); // instanciation du modele

        if (isset($cleanedUpPost['action'])) {
            switch ($cleanedUpPost['action']) {
                case 'add':
                    $prospFormChecker = new \MVCExo\controller\formsChecks\ProspClientFormsChecks();
                    $checkErrorMessage = $prospFormChecker->prospClientFormChecks($cleanedUpPost); // vérif de la conformité des données de $postContent

                    if (empty($checkErrorMessage)) {
                        $this->prospectModel->addProspect($cleanedUpPost);
                        echo "<script> window.location.replace('index.php?controller=prospect') </script>";
                    } else {
                        echo $checkErrorMessage;
                        echo "<script> window.location.replace('index.php?controller=prospect') </script>";
                    }
                    break;

                case 'edit':
                    $prospFormChecker = new \MVCExo\controller\formsChecks\ProspClientFormsChecks();
                    $checkErrorMessage = $prospFormChecker->prospClientFormChecks($cleanedUpPost); // vérif de la conformité des données de $postContent

                    if (empty($checkErrorMessage)) {
                        $this->prospectModel->editProspect($cleanedUpPost);
                        echo "<script> window.location.replace('index.php?controller=prospect') </script>";
                    } else {
                        echo $checkErrorMessage;
                        echo "<script> window.location.replace('index.php?controller=prospect') </script>";
                    }
                    break;

                case 'delete':
                    if (empty($checkErrorMessage)) {
                        $this->prospectModel->deleteProspect($cleanedUpPost);
                    }
                    echo "<script> window.location.replace('index.php?controller=prospect') </script>";
                    break;

                default:
                    echo "<script> window.location.replace('index.php?controller=prospect') </script>";
            }
        } else {
            echo "<script> window.location.replace('index.php?controller=prospect') </script>";
        }
    }
}
