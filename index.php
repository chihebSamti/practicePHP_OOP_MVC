<?php
use App\Autoloader;
use App\Db\Db;
use App\Models\AnnoncesModel;
use App\Models\UserModel;
use App\Models\UsersModel;

require_once 'Autoloader.php';
Autoloader::register();

$model = new AnnoncesModel;
$model2 = new UsersModel;



