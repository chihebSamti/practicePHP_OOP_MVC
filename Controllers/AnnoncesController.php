<?php
namespace App\Controllers ;

use App\Models\AnnoncesModel;

class AnnoncesController extends Controller
{
  /**
   * cette methode affiche une page list toutes annonce de la base 
   * @return void
   */
  public function index()
  { // on instancie le modele correspondant a la table 'annonces'
    $annoncesModel = new AnnoncesModel;

    //on va chercher toute les annonce
    $annonces = $annoncesModel->findBy(["actif"=>1]);
    
    // on gener la vue
    $this->render('annonces/index' , compact('annonces'));  
  }

  /**
   *cette method affiche 1 annonce
   * @param integer $id
   * @return void
   */
  public function lire(int $id){
    //on instancie le model
    $annoncesModel = new AnnoncesModel;

    //on va chercher une annonce
    $annonces = $annoncesModel->find($id);
    
    //on envoie a la vue
    $this->render('annonces/lire', compact('annonces'));
  }
}