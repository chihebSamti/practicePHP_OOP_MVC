<?php
namespace App\Controllers;

abstract class Controller
{
  public function render(string $fichier, array $donnees = [], string $template = 'default')
  {
    // on extrait le contenu de $donnees 
    extract($donnees);

    // on demarre le buffer de sorti
    ob_start();

    // a partir de ce niveau toute sortie est conservee en memoire

    
    
    //on cree le chemin vers la vue
    require_once ROOT.'/Views/'.$fichier.'.php';
    
    $contenu = ob_get_clean();

    require_once  ROOT.'/Views/'.$template.'.php';
  }
}