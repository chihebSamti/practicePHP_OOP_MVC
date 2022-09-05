<?php
namespace App\Banque;

use App\Client\Compte as CompteClient;

/**
 * bank account object
 */
abstract class Compte
{
  private CompteClient $titulaire;
  protected float $solde;

  public function __construct(CompteClient $compte, float $montant=100){
    $this->titulaire = $compte;
    $this->solde = $montant;
  }

  /**
   * titulaire getter
   *
   * @return string
   */
  public function getTitulaire():CompteClient {
    return $this->titulaire;
  }

  /**
   * update titulaire nom
   * @param string $nom
   * @return self
   */
  public function setTitulaire(CompteClient $compte):self {
    if(isset($compte)){
       $this->titulaire = $compte;
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