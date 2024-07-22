<?php

require_once 'src/Models/SongsModel.php';
require_once 'src/Services/DatabaseConnector.php';

$db = DatabaseConnector::connect();

$songs = new SongsModel($db);

echo '<pre>';
var_dump($songs);

