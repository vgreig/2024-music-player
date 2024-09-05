<?php
declare(strict_types=1);
require_once 'src/Services/DatabaseConnector.php';
require_once 'src/Models/SongsModel.php';

$db = DatabaseConnector::connect();
$songsModel =  new SongsModel($db);

$searchResults = $songsModel->searchSongName('');
if (isset($_GET['search'])){
    $songSearchResults = $songsModel->searchSongName($_GET['search']);
}


