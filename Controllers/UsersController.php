<?php
namespace App\Controllers;
use App\Core\Form;

class UsersController extends Controller {

  public function login() {
    $form = new Form;

    $form->debutForm('get','login.php', ['class'=>'form'])
          ->ajoutLabelFor('email', 'Email :')
          ->AjoutInput('email', 'email', ['class' => 'form-control', 'id'=>'email'])
          ->ajoutLabelFor('pass', 'mot de passe :' )
          ->AjoutInput('password', 'password', ['id'=> 'pass', 'class'=>'form-control'])
          ->ajoutBouton('envoyer', ['class'=>'btn btn-primary'])
          ->finForm();

    $this->render('users/login', ['loginForm'=> $form->create()]);
  }
}