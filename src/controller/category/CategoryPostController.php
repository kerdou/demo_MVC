<?php

namespace MVCExo\controller\category;

use MVCExo\Autoloader;

Autoloader::register();


/** Controleur de la section 'catégorie' */
class CategoryPostController extends CategoryCommonController
{
    private array $postContent = array(); // Données nettoyées provenants de $_POST

    /** Récupére [$_POST['action']], lance la modif de DB voulue puis lance l'affichage de la page necessaire
     * * Les header('location: DESTINATION') permettent de vider le $_POST pour éviter de renvoyer une commande du $_POST à cause d'un appui sur F5
     */
    public function actionReceiver(array $cleanedUpPost)
    {
        $this->postContent = $cleanedUpPost;
        $this->instanciateModel();

        if (isset($this->postContent['action'])) {
            switch ($this->postContent['action']) {
                case 'add':
                    $catFormChecker = new \MVCExo\controller\formsChecks\CatFormsChecks();
                    $checkErrorMessage = $catFormChecker->catFormInputChecks($this->postContent); // vérif de la conformité des données de $postContent

                    if (empty($checkErrorMessage)) {
                        $this->categoryModel->addCategory($this->postContent);
                        header('location: index.php?controller=category');
                    } else {
                        echo $checkErrorMessage;
                        header('refresh:0; url=index.php?controller=category');
                    }
                    break;

                case 'edit':
                    $catFormChecker = new \MVCExo\controller\formsChecks\CatFormsChecks();
                    $checkErrorMessage = $catFormChecker->catFormInputChecks($this->postContent); // vérif de la conformité des données de $postContent

                    if (empty($checkErrorMessage)) {
                        $this->categoryModel->editCategory($this->postContent);
                        header('location: index.php?controller=category');
                    } else {
                        echo $checkErrorMessage;
                        header('refresh:0; url=index.php?controller=category');
                    }
                    break;

                case 'delete':
                    $this->categoryModel->deleteCategory($this->postContent);
                    header('location: index.php?controller=category');
                    break;

                default:
                    header('location: index.php?controller=category');
            }
        } else {
            header('location: index.php?controller=category');
        }
    }
}
