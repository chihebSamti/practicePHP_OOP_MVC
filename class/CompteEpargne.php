<?php

/**
 * compte avec taux d'interet
 */
class CompteEpargne extends Compte{

  private $tauxInterets;


  /**
   * constructeur de compte epargne
   * @param string $nom nom de titulaire
   * @param float $montant montant de sold a l'ouverture
   * @param integer $tauxInterets taux d'interet
   * @return void
   */
  public function __construct(string $nom, float $montant, int $tauxInterets)
  { 
    parent::__construct($nom,$montant);
    $this->tauxInterets = $tauxInterets;
    
  }


  /**
   * get taux d'interet
   * @return int
   */
  public function getTauxInterets(): int {
    return $this->tauxInterets;
  }

  /**
   *set un taux d'interet
   * @param int taux d'interets
   * @return self
   */
  public function setTauxInterets($tauxInterets): self {
    if($tauxInterets >= 0 ){
      $this->tauxInterets = $tauxInterets;
      return $this;
    } else {
      echo " taux d'interet invalide";
    }
  }

  public function verserInteret(){
    $this->solde += $this->solde * $this->tauxInterets / 100 ;
    return $this->solde;
  }






}




?>