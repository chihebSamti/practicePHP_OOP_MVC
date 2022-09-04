<?php
class CompteEpargneCourant extends CompteEpargne {
  private $decouvert;


  /**
   *constructeur de compte courant
   * @param string $nom num de titulaire
   * @param integer $montant montant de sold à l'ouverture
   * @param integer $decouvert découvert autorisé 
   * @return void
   */
  public function __construct(string $nom, float $montant=100, int $tauxInterets, int $decouvert){

    //transferer les infos au constructeur
    parent::__construct($nom, $montant, $tauxInterets);

    $this->decouvert = $decouvert;
  }

  public function  getDecouvert():int{

    return $this->decouvert;
  }
    
  public function setDecouvert(int $montant):self {
    if($montant >= 0 ){
      $this->decouvert = $montant;
    }
    return $this;
  }

  public function retirer (float $montant){
    //on decouvert si le decouvert permet le retrait 
    if($montant > 0 && $this->solde - $montant >= -$this->decouvert){
      $this->solde -= $montant;

    }else{
      echo "solde insuffisant" ;
    }



  }
  










}










?>