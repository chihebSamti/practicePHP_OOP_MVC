<?php
namespace App\Models;
use App\Core\Db;

class Model extends Db{
  // table de la base de données 
  protected $table;

  // instance de Db
  private $db;

  //start read methodes :
  public function find(int $id){

    return $this->requete("SELECT * FROM {$this->table} Where id = $id")->fetch();
  }
  
  public function findAll(){
    $sql = 'SELECT * FROM '.$this->table;
    $query = $this->requete($sql);

    return $query->fetchAll();
  }

  public function findBy(array $criteres){
    $champs = [];
    $valeurs = [];
    
    // on boucle pour eclater le tablau 
    foreach ($criteres as $champ => $valeur) {
      // SELECT * FROM annonces WHERE actif = ?
      // bindValue(1, value)
      $champs[]="$champ = ?";
      $valeurs[]= $valeur;
    }
    // on transforme le tableau "champ" en chaine de caractere 
    $liste_champs = implode('AND ' , $champs );
  
    //on execute la requete 
    return $this->requete('SELECT * FROM '.$this->table.' WHERE '. $liste_champs, $valeurs )
    ->fetchAll();
  }
  // end read methodes .
  
  // create methode :

  public function create(Model $model){
    $champs = [];
    $inter = [];
    $valeurs = [];
    
    // on boucle pour eclater le tablau 
    foreach ($model as $champ => $valeur) {
      // INSERT INTO annonces (champs) VALUES (valeur, ?, ?, ? )
      if($valeur != null && $champ != 'db' && $champ != 'table'){
        $champs[]=$champ ;
        $inter[]="?";
        $valeurs[]= $valeur;
      }
    }
    // on transforme le tableau "champ" en chaine de caractere 
    $liste_champs = implode(', ' , $champs );
    $list_inter = implode(', ', $inter);

    //on execute la requete 
    return $this->requete('INSERT INTO '.$this->table.' ('.$liste_champs.') 
                          VALUES ('. $list_inter.')', $valeurs );
  }

  //update methode
  public function update(int $id, Model $model){
    $champs = [];
    $valeurs = [];
    
    // on boucle pour eclater le tablau 
    foreach ($model as $champ => $valeur) {
      // UPDATE annonces SET Titre = ?, description = ? , ... WHERE id = ?
      if($valeur !== null && $champ != 'db' && $champ != 'table'){
        $champs[]="$champ = ?" ;
        $valeurs[]= $valeur;
      }
    }
    $valeurs[] = $id ;
    // on transforme le tableau "champ" en chaine de caractere 
    $liste_champs = implode(', ' , $champs );
    //on execute la requete 
    return $this->requete('UPDATE '.$this->table.' SET '.$liste_champs.'WHERE id = ?', $valeurs );
  }
  
  //delete function
  public function delete($id){
    return $this->requete("DELETE FROM {$this->table} WHERE id = ?", [$id]);
  }
  
  //preparer et execute les requetes 
  protected function requete(string $sql, array $attributs = null){
    //instancier ou recuperer l'instance de Db
    $this->db = Db::getInstance();
    //on verifie si on a des attributs 
    if($attributs !== null){
      //Requete preparer 
      $query = $this->db->prepare($sql);
      $query->execute($attributs);
      return $query;
    }else{
      //requete simple
      return $this->db->query($sql);
    }
  }

  // methode hydrate
  public function hydrate(array $donnees){
    foreach ($donnees as $key => $value){
      // on recupere le nom du setter corresspondant a la clé (key)
      // titre -> setTitre
      $setter = 'set'.ucfirst($key);

      //on verifie si le seter existe
      if(method_exists($this, $setter)){
        // on appelle le setter
        $this->$setter($value);
      }
    }
    return $this;
  }

}