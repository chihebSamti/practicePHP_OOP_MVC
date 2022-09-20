<?php
namespace App\Controllers;

use App\Models\AnnoncesModel;

class AdminController extends Controller {

  /**
   * verifie si on est admin
   *
   * @return boolean
   */
  public function isAdmin() {
    // on verifie si on est connecté 
    // on verifie si le role admin est dans nos role
    if(isset($_SESSION['user']) && in_array('ROLE_ADMIN', $_SESSION['user']['roles'])){
      //on est admin
      return true;
    }else{
      $_SESSION['error']= " your not allowed to this zone";
      header('location:'.URL);
      exit;

    }
  }

  public function index() {
    //  on verifie si on est admin 
    if($this->isAdmin()) {
      $this->render('admin/index', [], 'admin' );
    }
  }

  /**
   * Undocumented function
   *
   * @return void
   */
  public function annonces(){
    if($this->isAdmin()){
      $annoncesModel = new AnnoncesModel;
      $annonces = $annoncesModel->findAll();
      $this->render('admin/annonces', compact('annonces'), 'admin');
    }
  }

  /**
   * supprime une annonce si on est admin
   *
   * @param [type] $id
   * @return void
   */
  public function supprimeAnnonce($id) {
    if($this->isAdmin()){
      $annonce = new AnnoncesModel;
      $annonce->delete($id);
      header('Location: '.$_SERVER['HTTP_REFERER']);
    }
  }

  /**
   * activer une annonce
   * @param integer $id
   * @return void
   */
  public function activeAnnonce(int $id) {
    if ($this->isAdmin()) {
      $annoncesModel = new AnnoncesModel;
      $annonceArray = $annoncesModel->find($id);

      if($annonceArray){
        $annonce = $annoncesModel->hydrate($annonceArray);
        $annonce->setActif($annonce->getActif()? 0 : 1 );

        $annonce->update();

      }
    }
  }


 
  
}

