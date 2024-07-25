<?php

declare(strict_types=1);

require('vendor/autoload.php');
require_once 'src/Services/DatabaseConnector.php';
require_once 'src/Models/ArtistsModel.php';
require_once 'src/Models/SongsModel.php';

$db = DatabaseConnector::connect();

$artist = new ArtistsModel($db);
$song= new SongsModel($db);



