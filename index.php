<?php

use App\Autoloader;
use App\Client\Compte as CompteClient ; 
use App\Banque\{CompteCourant, CompteEpargne, CompteEpargneCourant};

require_once 'class/Autoloader.php';
Autoloader::register();

$nom = "chiheb";
$solde = 500;
$decouvert = 100;
$compteCourant = new CompteCourant($nom, $solde, $decouvert);
$compteCourant->retirer(200);
var_dump($compteCourant);

$compteEpargne = new CompteEpargneCourant("samti", 200, 3, 50);
$compteEpargne-> verserInteret();
var_dump($compteEpargne);

CompteClient::success(); 


