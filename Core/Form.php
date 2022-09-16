<?php
namespace App\Core ;

class Form {
  private $formCode = '';

  /**
   * generate HTML form 
   * @return void
   */
  public function create() {
    return $this->formCode;
  }

  /**
   * validation de formulaire tou les champ sont remplis
   * @param array $form tableau issu de form $_GET , $_POST
   * @param array $champs tableau list les champ obligatoire
   * @return void
   */
  public static function validate(array $form, array $champs) {
    foreach($champs as $champ) {
      // on verifie si le champ est absent ou vide 
      if(!isset($form[$champ]) || empty($form[$champ]) ) {
        return false ;
      }
    }
    return true ;
  }

  /**
   * add attributs to html balise
   *
   * @param array $attributs tableau assoc [ class => formcontrol, required => true, ...]
   * @return string chaine de caractere generee
   */
  private function addAttributs(array $attributs) {
    // on initialise une chaine de caractere 
    $str = '';
    
    //on list les attr "court" 
    $courts = ['checked', 'disabled', 'readonly', 'multiple', 'required', 'autofocus', 
    'novalidate', 'formnovalidate'];

    foreach($attributs as $attribut => $valeur) {
      if(in_array($attribut, $courts) && $valeur == true ) {
        $str .= " $attribut";
      }else{
        $str .= " $attribut=\"$valeur\"";
      }
    }
    return $str;
  }

  /**
   * Balise ouverture de formulaire
   * @param string $method
   * @param string $action
   * @param array $attributs
   * @return Form
   */
  public function debutForm(string $method = 'POST', string $action = '#', array $attributs = []): self {
    // on creee la balise form
    $this->formCode .= "<form method='$method' action='$action' " ;

    // on ajoute les atribut eventuelle
    $this->formCode .= $attributs ? $this->addAttributs($attributs).'>': '>';
    
    return $this;
  }

  /**
   * ajout d'un label
   * @param string $for 
   * @param string $text
   * @param array $attributs
   * @return self
   */
  public function ajoutLabelFor(string $for, string $text, array $attributs = []) : self {
    //on ouvre la balise 
    $this->formCode .= "<label for='$for'";

    //on ajout les attributs
    $this->formCode .= $attributs ? $this->addAttributs($attributs) : '';

    //on ajout le text 
    $this->formCode .= ">$text</label>";
    
    return $this;
  }

  /**
   *ajout d'input
   * @param string $type
   * @param string $nom
   * @param array $attributs
   * @return self
   */
  public function ajoutInput(string $type, string $nom, array $attributs=[]) :self {
    // on ouvre la balise 
    $this->formCode .= "<input type='$type' name='$nom'";

    //on ajout les attributs
    $this->formCode .= $attributs ? $this->addAttributs($attributs).'>' : '>';

    return $this;
  }

  public function ajoutTextArea(string $nom, string $valeur ='', array $attributs = []) : self {
        //on ouvre la balise 
        $this->formCode .= "<textarea name='$nom'";

        //on ajout les attributs
        $this->formCode .= $attributs ? $this->addAttributs($attributs) : '';
    
        //on ajout le text 
        $this->formCode .= ">$valeur</textarea>";
    return $this;
  }

  public function ajoutSelect(string $nom, array $options, array $attributs = []) : self {
    // on cree le select 
    $this->formCode .= "<select name ='$nom'";

    //on ajout les attribut
    $this->formCode .= $attributs ? $this->addAttributs($attributs).'>' : '>';

    //ajouter les option 
    foreach($options as $valeur => $text){
      $this->formCode .= "<option value=\"$valeur\">$text</option>";
    }

    //on ferme le select
    $this->formCode .= '</select>';

    return $this;
  }

  public function ajoutBouton(string $text, array $attributs = []) : self {
    //on ouvert la balise
    $this->formCode .= "<button ";

    // on ajoute les attributs
    $this->formCode .= $attributs ? $this->addAttributs($attributs):'';

    //on ajout le text est on ferme
    $this->formCode .= ">$text</button>";
    
    return $this;
  }

  /**
   * balise de fermeture de formulaire
   * @return self
   */
  public function finForm() :self {
    $token = md5(uniqid());
    $this->formCode .= " <input type='hidden' name='token' value='$token'>";
    $this->formCode .= "</form>";
    $_SESSION['token'] = $token;

    return $this;
  }
}