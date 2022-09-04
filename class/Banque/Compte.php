<?php
namespace App\Banque;

/**
 * bank account object
 */
abstract class Compte
{
  private string $titulaire;
  protected float $solde;

  public function __construct(string $nom, float $montant=100){
    $this->titulaire = $nom;
    $this->solde = $montant;
  }

  /**
   * titulaire getter
   *
   * @return string
   */
  public function getTitulaire():string {
    return $this->titulaire;
  }

  /**
   * update titulaire nom
   * @param string $nom
   * @return self
   */
  public function setTitulaire(string $nom):self {
    if($nom !=''){
       $this->titulaire = $nom;
    }
    return $this;
  }

  /**
   * return sold
   * @return float
   */ 
  public function getSold():float {
    return $this->solde;
  }

  /**
   * set new sold
   * @param float $montant
   * @return self
   */
  public function setSold(float $montant):self {
    if ($montant >= 0) {
      $this->solde = $montant;
    }
    return $this;
  }

  public function deposer($montant){
    if ($montant > 0) {
      $this->solde += $montant;
    }
  }  

  public function voirSolde(){
    return "Le solde du compte est de $this->solde euros";
  }

  /**
   * retier un montant du solde du compte 
   * @param float $montant
   * @return void
   */
  public function retirer(float $montant){
    if($montant > 0 && $this->solde >= $montant){
      $this->solde -= $montant;
    }else{
      echo "Montant invalide ou solde insuffisant";
    }
  }
}
























?>