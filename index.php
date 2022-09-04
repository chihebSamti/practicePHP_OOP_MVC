<?php
require_once 'class/Compte.php';
require_once 'class/CompteCourant.php';
require_once 'class/CompteEpargne.php';
require_once 'class/CompteEpargneCourant.php';


$nom = "chiheb";
$solde = 500;
$decouvert = 100;

$compteCourant = new CompteCourant($nom, $solde, $decouvert);

$compteCourant->retirer(200);


var_dump($compteCourant);


$compteEpargne = new CompteEpargneCourant("samti", 200, 3, 50);

$compteEpargne-> verserInteret();

var_dump($compteEpargne);



?>