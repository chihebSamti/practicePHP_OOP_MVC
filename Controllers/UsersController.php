<?php
namespace App\Controllers;
use App\Core\Form;
use App\Models\UsersModel;

class UsersController extends Controller {

  /**
   * login user
   *
   * @return void
   */
  public function login() {
    
    // on verifie que le formulaire est complet 
    if(Form::validate($_POST, ['email', 'password'])){
      
      // le formulaire est complet 
      // on va chercher dans la base de donnee l'utilisateur avec l'email entré 
      $userModel = new UsersModel;
      $userArray = $userModel->findOneByEmail(strip_tags($_POST['email']));

      // l'utilisateur n'existe pas
      if(!$userArray){
        // on envoie un message de session 
        $_SESSION['loginError'] = 'l\'adressse mail et ou le mot de pass est incorrect';
        header('location:'.URL.'/users/login');
        exit;
      }
      //l'utilisateur exist
      $user = $userModel->hydrate($userArray);
      
      // on verifie si le mot de passe est correct
      if(password_verify($_POST['password'], $user->getPassword())){
      // le mot de pass est bon 
      // on cree la session
      $user ->setSession();
      header('location:'.URL);
      exit;
      
      }else{
        //mauvais mot de pass 
          $_SESSION['loginError'] = 'l\'adressse mail et ou le mot de pass est incorrect';
          header('location:'.URL.'/users/login');
          exit;  
      }
    }

    $form = new Form ;
    $form->debutForm()
          ->ajoutLabelFor('email', 'Email :')
          ->ajoutInput('email', 'email', ['class' => 'form-control', 'id'=>'email'])
          ->ajoutLabelFor('pass', 'mot de passe :' )
          ->ajoutInput('password', 'password', ['id'=> 'pass', 'class'=>'form-control'])
          ->ajoutBouton('envoyer', ['class'=>'btn btn-primary'])
          ->finForm();

    $this->render('users/login', ['loginForm'=> $form->create()]);
  }


  /**
   * inscription user
   *
   * @return void
   */
  public function register(){
    // on verifie si le formulaire est valide 
    
    if(Form::validate($_POST, ['email', 'password'])){

      // on nettoie l'adresse mail 
      $email = strip_tags($_POST['email']);
      
      // chiffrer le mote de passe 
      $pass = password_hash($_POST['password'], PASSWORD_ARGON2I) ;

      // on hydrate l'utilisateur dans la base de donnees
      $user = new UsersModel;

      $user->setEmail($email)
            ->setPassword($pass) 
            ;

      // on stock l'utilisateur 
      $user->create();
    }

    $form = new form;
    $form->debutForm()
        ->ajoutLabelFor('email', 'Email :')
        ->ajoutInput('email', 'email', ['id'=>'email', 'class'=>'form-control'])
        ->ajoutLabelFor('pass', 'Mote de passe :')
        ->ajoutInput('password', 'password', ['id'=>'pass', 'class'=>'form-control'])
        ->ajoutBouton('M\'inscrire', ['class'=>'btn btn-primary'])
        ->finForm()
        ;
        
    $this->render('users/register', ['registerForm'=> $form->create()]);
    
  }

  /**
   *deconnecte l'utilisateur 
   * @return void
   */
  public function logout(){
     unset($_SESSION['user']);
     header('location:'.$_SERVER['HTTP_REFERER']);
     exit;
  }
}