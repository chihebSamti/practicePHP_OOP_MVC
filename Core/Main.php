<?php

namespace App\Core;

use App\Controllers\MainController;

class Main{
  public function start(){
    // on demarre la session
    session_start();
    

    // netoyage url + eviter le contenu double
    // On récupere l'URL
    $uri = $_SERVER['REQUEST_URI'];

    //on verifie que URI n'est pas vide et se termine par un /
    if(!empty($uri) && $uri != URL && $uri[-1] === "/"){
      // on envleve le /
      $uri = substr($uri, 0, -1);

      // on envoie un code de redirection permanente 
      http_response_code(301);

      //on redirige vers l'URL sans / 
      header('location: '.$uri);
    }
    
    //on gére les parametre d'URL
    //p = controleur/methode/parametre
    //on sépare les parametre dans un tableau
    $params = [];
    if (isset($_GET['p'])){
      $params = explode('/', $_GET['p']);
    }

    if ($params[0] != ''){
      // on recupere le nom de controlleur a instancier 
      // on met une majuscule en 1ere lettre, on ajoute le namespace avant et on ajoute "controller" aprés 
      $controller = '\\App\\Controllers\\'.ucfirst(array_shift($params)).'Controller';

      if(class_exists($controller)){
          $controller = new $controller;

          $action = (isset($params[0])) ? array_shift($params) : 'index';
        if (method_exists($controller, $action)) {
          // on verifi si il rest des params 
          (isset($params[0])) ? call_user_func_array([$controller, $action], $params) : $controller->$action();
        }else{
          http_response_code(404);
          echo "la page recherché n'existe pas this" ;
        }
      }else{
        echo " la page recherché n'existe pas" ;
      }
      // on instanci le controlleur

      //on recupere le 2eme param

    }else{
      // on n'a pas de param 
      // on instanci le controlleur par defaut
      $controller = new MainController;

      // on appelle la methode index
      $controller->index();
    }




  }
}