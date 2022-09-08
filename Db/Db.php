<?php
namespace App\Db;

use PDO;
use PDOException;

class Db extends PDO{
  // instance unique de la class 
  private static $instance;

  //information de connection;
  private const DBHOST = 'localhost';
  private const DBUSER = 'root';
  private const DBPASS = '';
  private const DBNAME = 'demo_poo';

  private function __construct(){
    // dsn de connection
    $_dsn = 'mysql:dbname='.self::DBNAME.'; host='.self::DBHOST;

    // on appelle le constructeur de PDO
    try {
      parent::__construct($_dsn, self::DBUSER, self::DBPASS);
      $this->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, 'SET NAMES utf8');
      $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo'connected to database '.self::DBNAME ;
      
    } catch (PDOException $e) {
      die($e->getMessage());
    }
  }

  public static function getInstance(){
    if(self::$instance === null){
      self::$instance = new self();
    } 
    return self::$instance ;
  }
}