<?php

/**
 * Classe mère des view
 * 
 * Classes filles directes:
 * HomeView
 * CategoryView 
 * ProspectClientView
 */
class ViewInChief {

    /**
     * @var object contient tout le contenu de la page à générer
     * @access protected
     */
    protected $pageContent;


    
    /**
     * construction automatique avec inclusion du head et du nav de la page
     * @access public
     * appelé depuis toutes les classes model filles
     */    
    public function __construct() {
        $this->pageContent = file_get_contents('public/html/head.html'); 
        $this->pageContent .= file_get_contents('public/html/nav.html');                  
    }



    /**
     * configure le <title> de la page et passe l'icone du <nav> de la page en cours en active (classe Boostrap)
     * @access public
     * @param $pageSettings array contenant le paramêtrage de la page.
     * appelé depuis toutes les classes view filles suivantes:
     * view/homeview/HomeView
     * view/catview/CategoryView
     * view/prospclientview/clientview/ClientView
     * view/prospclientview/prospview/ProspectView
     */ 
    protected function pageSetup($pageSettings){
        $this->pageContent = str_replace("{pageTitle}",         $pageSettings["pageTitle"],         $this->pageContent);
        $this->pageContent = str_replace("{activeHome}",        $pageSettings["activeHome"],        $this->pageContent);
        $this->pageContent = str_replace("{activeCat}",         $pageSettings["activeCat"],         $this->pageContent);
        $this->pageContent = str_replace("{activeProsp}",       $pageSettings["activeProsp"],       $this->pageContent);
        $this->pageContent = str_replace("{activeClient}",      $pageSettings["activeClient"],      $this->pageContent);
    }



    /**
     * récupére chaque ligne des tableaux venant de la base et les converti en HTML.
     * évite que les liens EDIT ou DELETE des tableaux ne soient corrompus à cause de caractéres spéciaux
     * @access protected
     * @param $arrayToConvert array inclut le contenu d'une ligne de tableau
     * @return le contenu converti en HTML
     * appelé depuis les classes view filles ayant un tableau à afficher:
     * view/homeview/table/HomeTableView
     * view/catview/table/CategoryTableView
     * view/prospclientview/prospview/table/ProspectTableView
     * view/prospclientview/clientview/table/ClientTableView
     */
    protected function htmlCharConvert($arrayToConvert){
        foreach ($arrayToConvert as $key => $value) {
            $arrayToConvert[$key] = htmlentities($value, ENT_QUOTES);
        }       
        return $arrayToConvert;
    }



    /**
     * configure le titre du tableau, met la bonne adresse au <form action=""> et met le bon texte sur le bouton d'ajout
     * en haut et en bas du tableau quand la page est affichée sur mobile.
     * @access protected
     * @param $tableSettings array contenant le paramêtrage du tableau.
     * appelé depuis toutes les classes view filles suivantes:
     * view/catview/table/CategoryTableView
     * view/prospclientview/prospview/table/ProspectTableView
     * view/prospclientview/clientview/table/ClientTableView      
     */     
    protected function tableSetup($tableSettings){
        $this->pageContent = str_replace("{tableTitle}",        $tableSettings["tableTitle"],       $this->pageContent);
        $this->pageContent = str_replace("{addLink}",           $tableSettings["addLink"],          $this->pageContent);
        $this->pageContent = str_replace("{addLinkText}",       $tableSettings["addLinkText"],      $this->pageContent);
    }

    /**
     * rajoute le footer en bas de page puis affiche le contenu du pageContent
     * @access protected
     * appelé depuis toutes les clsses view filles suivantes:
     * view/homeview/table/HomeTableView
     * view/catview/form/CategoryFormView
     * view/catview/table/CategoryTableView
     * view/prospclientview/ProspectClientView
     * view/prospclientview/clientview/table/ClientTableView
     * view/prospclientview/prospview/table/ProspectTableView
     */
    protected function pageDisplay(){
        $this->pageContent .= file_get_contents('public/html/footer.html'); 
        echo $this->pageContent;
    }
}


