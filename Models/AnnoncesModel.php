<?php
namespace App\Models;

class AnnoncesModel extends Model{

  protected $id;
  protected $titre;
  protected $description;
  protected $created_at ;
  protected $actif = 0;
  protected $user_id;

  public function __construct(){

    $this->table = "annonces";
  }

  /**
   * Get the value of actif
   */ 
  public function getActif()
  {
    return $this->actif;
  }

  /**
   * Set the value of actif
   *
   * @return  self
   */ 
  public function setActif($actif)
  {
    $this->actif = $actif;

    return $this;
  }

  /**
   * Get the value of created_at
   */ 
  public function getCreated_at()
  {
    return $this->created_at;
  }

  /**
   * Set the value of created_at
   *
   * @return  self
   */ 
  public function setCreated_at()
  {
    $this->created_at =   date('Y-m-d');

    return $this;
  }

  /**
   * Get the value of description
   */ 
  public function getDescription()
  {
    return $this->description;
  }

  /**
   * Set the value of description
   *
   * @return  self
   */ 
  public function setDescription($description)
  {
    $this->description = $description;

    return $this;
  }

  /**
   * Get the value of id
   */ 
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set the value of id
   *
   * @return  self
   */ 
  public function setId($id)
  {
    $this->id = $id;

    return $this;
  }

  /**
   * Get the value of titre
   */ 
  public function getTitre()
  {
    return $this->titre;
  }

  /**
   * Set the value of titre
   *
   * @return  self
   */ 
  public function setTitre($titre)
  {
    $this->titre = $titre;

    return $this;
  }

  /**
   * Get the value of user_id
   */ 
  public function getUser_id():int
  {
    return $this->user_id;
  }

  /**
   * Set the value of user_id
   *
   * @return  self
   */ 
  public function setUser_id(int $user_id)
  {
    $this->user_id = $user_id;

    return $this;
  }
}