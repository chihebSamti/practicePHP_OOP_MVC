<?php
namespace App\Controllers ;

use App\Core\Form;
use App\Models\AnnoncesModel;

class AnnoncesController extends Controller
{
  /**
   * cette methode affiche une page list toutes annonce de la base 
   * @return void
   */
  public function index(){ // on instancie le modele correspondant a la table 'annonces'
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

  public function ajouter(){
    if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])){
      // l'utilisateur est connecter
      // on verifie si le formulaire est complet 
      if (Form::validate($_POST, ['titre', 'description'])){
        
        // le formulaire est complet
        // on se protege contre les faille xss 
        $titre = strip_tags($_POST['titre']);
        $description = strip_tags($_POST['description']);

        // on instancie notre model 
        $annonce = new AnnoncesModel ;

        
        // on hydrate
        $annonce->setTitre($titre)
        ->setDescription($description)
        ->setUser_id($_SESSION['user']['id'])
        ->setCreated_at()
        ;
        
        //on enrgistre dans le db
        $annonce->create();
        

        //on rederige
        $_SESSION['message'] = "votre annonce a été entregistrée avec succés" ;
        header('location: '.URL.'/annonces') ;
        exit;

      }else{
        //le formulaire incomplet
        $_SESSION['formError'] = !empty($_POST) ? "Completer le formulaire svp." : "";
        $titre = isset($_POST['titre']) ? strip_tags($_POST['titre']) : '';
        $description = isset($_POST['description']) ? strip_tags($_POST['description']) : '';
      }


      $form = new Form;

      $form->debutForm()
           ->ajoutLabelFor('titre', 'Titre de l\'annonce :')
           ->ajoutInput('text', 'titre', [
                        'id'=>'titre',
                        'class'=>'form-control',
                        'value' => $titre
                        ])
           ->ajoutLabelFor('description', 'Text de l\'annonce :')
           ->ajoutTextArea('description', $description, [
                        'id'=> 'description',
                        'class' => 'form-control'
                        ])
           ->ajoutBouton('Ajouter', ['class' => 'btn btn-primary'])
           ->finForm()
           ;
      
      $this->render('annonces/ajouter', ['form' => $form->create()]);
      
    }else{
      // l'utilisateur n'est pas connecter
      $_SESSION['error'] = "vous devez etre connecter pour creer une annonce" ;
      header('location: '.URL.'/users/login') ;
      exit;
    }
  }

  public function modifier($id){
    if(isset($_SESSION['user']) && !empty($_SESSION['user']['id'])){
      // on va verifier si l'annonce exist dans la base de donnée
      // on instancie notre model 
      $annoncesModel = new AnnoncesModel ;

      // on cherche l'annonce avec l'id
      $annonce = $annoncesModel->find($id);

      // si l'annonce n'existe pas on retourne a l'accueil
      if(!$annonce){
        http_response_code(404);
        $_SESSION['error'] = "l'annonce rechercher n'existe pas ";
        header('location: '.URL.'/annonces');
        exit ;
      }


      //on verifie si l'utilisateur est proprietaire de l'annonce
      if ($annonce->user_id !== $_SESSION['user']['id']){
        if (!in_array('ROLE_ADMIN', $_SESSION['user']['roles'])){
          $_SESSION['error'] = "vous n'avez pas acces a cette page" ;
          header('location: '.URL.'/annonces');
          exit;
        }
      };

      //on traite le formulaire
      if(Form::validate($_POST, ['titre', 'description'])){
        //on se protege contre les faille xss
        $titre = strip_tags($_POST['titre']);
        $description = strip_tags($_POST['description']);

        //on stock l'annonce
        $updatedAnnonce = new AnnoncesModel;

        // on hydrate
        $updatedAnnonce->setId($annonce->id)
                       ->setTitre($titre)
                       ->setDescription($description)
                       ->setActif(1)
                       ;
        
        // on update l'annonce
        $updatedAnnonce->update();

        //on rederige
        $_SESSION['message'] = "votre annonce a été modifier avec succés" ;
        header('location: '.URL.'/annonces') ;
        exit;

      }

      
      $form = new Form;

      $form->debutForm()
           ->ajoutLabelFor('titre', 'Titre de l\'annonce :')
           ->ajoutInput('text', 'titre', [
              'id'=>'titre', 
              'class'=>'form-control',
              'value'=>$annonce->titre
              ])
           ->ajoutLabelFor('description', 'Text de l\'annonce :')
           ->ajoutTextArea('description', $annonce->description, [
              'id'=> 'description',
              'class' => 'form-control'
              ])
           ->ajoutBouton('Modifier', ['class' => 'btn btn-primary'])
           ->finForm()
           ;
      // on envoie a la vue 
      $this->render('annonces/modifier', ['form' => $form->create()]);

    }else{
      // L'utilisateur est oconnecter 
      $_SESSION['error'] = "vous dever etre connecter pour modifier une annonce " ;
      header('Location: '.URL.'/users/login') ;
      exit;
    }



  }
}