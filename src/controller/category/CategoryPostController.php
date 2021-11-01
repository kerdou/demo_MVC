<?php

namespace MVCExo\controller\category;

use MVCExo\Autoloader;

Autoloader::register();
/** Controleur de la section 'catégorie' */
class CategoryPostController extends CategoryCommonController
{
    /** Récupére [$_POST['action']], lance la modif de DB voulue puis lance l'affichage de la page necessaire */
    public function actionReceiver(array $cleanedUpPost)
    {
        $this->instanciateModel();

        if (isset($cleanedUpPost['action'])) {
            switch ($cleanedUpPost['action']) {
                case 'add':
                    $catFormChecker = new \MVCExo\controller\formsChecks\CatFormsChecks();
                    $checkErrorMessage = $catFormChecker->catFormInputChecks($cleanedUpPost); // vérif de la conformité des données de $postContent

                    if (empty($checkErrorMessage)) {
                        $this->categoryModel->addCategory($cleanedUpPost);
                        echo "<script>window.location = 'index.php?controller=category';</script>";
                    } else {
                        echo $checkErrorMessage;
                        echo "<script>window.location = 'index.php?controller=category';</script>";
                    }
                    break;

                case 'edit':
                    $catFormChecker = new \MVCExo\controller\formsChecks\CatFormsChecks();
                    $checkErrorMessage = $catFormChecker->catFormInputChecks($cleanedUpPost); // vérif de la conformité des données de $postContent

                    if (empty($checkErrorMessage)) {
                        $this->categoryModel->editCategory($cleanedUpPost);
                        echo "<script>window.location = 'index.php?controller=category';</script>";
                    } else {
                        echo $checkErrorMessage;
                        echo "<script>window.location = 'index.php?controller=category';</script>";
                    }
                    break;

                case 'delete':
                    $this->categoryModel->deleteCategory($cleanedUpPost);
                    echo "<script>window.location = 'index.php?controller=category';</script>";
                    break;

                default:
                    echo "<script>window.location = 'index.php?controller=category';</script>";
            }
        } else {
            echo "<script>window.location = 'index.php?controller=category';</script>";
        }
    }
}
