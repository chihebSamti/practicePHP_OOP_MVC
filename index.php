<?php

use App\Autoloader;
use App\Client\Compte as CompteClient ; 
use App\Banque\{CompteCourant, CompteEpargne, CompteEpargneCourant};

require_once 'class/Autoloader.php';
Autoloader::register();

$solde = 500;
$decouvert = 100;
$ville = "Paris";

$compte1 = new CompteClient("chiheb", "samti",$ville);
$compte2 = new CompteClient("fourat", "samti","Tunis");

$compteCourant = new CompteCourant($compte1, $solde, $decouvert);
$compteCourant->retirer(200);
var_dump($compteCourant);

$compteEpargne = new CompteEpargneCourant($compte2, 200, 3, 50);
$compteEpargne-> verserInteret();
var_dump($compteEpargne);



