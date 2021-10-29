<?php

namespace MVCExo\controller\prospect;

use MVCExo\Autoloader;

Autoloader::register();

/** Controleur de la section 'catégorie' */
class ProspectPostController extends ProspectCommonController
{
    private array $postContent = array(); // Données nettoyées provenants de $_POST

    /** Récupére [$_POST['action']], lance la modif de DB voulue puis lance l'affichage de la page necessaire
     * Les header('location: DESTINATION') permettent de vider le $_POST pour éviter de renvoyer une commande du $_POST à cause d'un appui sur F5
     */
    public function actionReceiver(array $cleanedUpPost)
    {
        $this->postContent = $cleanedUpPost;
        $this->instanciateModel(); // instanciation du modele

        if (isset($this->postContent['action'])) {
            switch ($this->postContent['action']) {
                case 'add':
                    $prospFormChecker = new \MVCExo\controller\formsChecks\ProspClientFormsChecks();
                    $checkErrorMessage = $prospFormChecker->prospClientFormChecks($this->postContent); // vérif de la conformité des données de $postContent

                    if (empty($checkErrorMessage)) {
                        $this->prospectModel->addProspect($this->postContent);
                        header('location: index.php?controller=prospect');
                    } else {
                        echo $checkErrorMessage;
                        header('refresh:0; url=index.php?controller=prospect');
                    }
                    break;

                case 'edit':
                    $prospFormChecker = new \MVCExo\controller\formsChecks\ProspClientFormsChecks();
                    $checkErrorMessage = $prospFormChecker->prospClientFormChecks($this->postContent); // vérif de la conformité des données de $postContent

                    if (empty($checkErrorMessage)) {
                        $this->prospectModel->editProspect($this->postContent);
                        header('location: index.php?controller=prospect');
                    } else {
                        echo $checkErrorMessage;
                        header('refresh:0; url=index.php?controller=prospect');
                    }
                    break;

                case 'delete':
                    if (empty($checkErrorMessage)) {
                        $this->prospectModel->deleteProspect($this->postContent);
                    }
                    header('location: index.php?controller=prospect');
                    break;

                default:
                    header('location: index.php?controller=prospect');
            }
        } else {
            header('location: index.php?controller=prospect');
        }
    }
}
