<?php

require_once 'src/Models/SongsModel.php';
require_once 'src/Entities/Song.php';
require_once 'src/Services/PlayCountService.php';
require_once 'src/Services/DatabaseConnector.php';

$db = DatabaseConnector::connect();

$songId = 3;

var_dump($_GET);

$id = $_GET['playSong'];

$playButton = new SongsModel($db);
$buttonTest = $playButton->getSongsByAlbum($songId);

$playButton = UpdatePlayCount::playCount(4);
echo $playButton;

$instantiate = new UpdatePlayCount($db);
$instantiate->updateDatabase($id);
