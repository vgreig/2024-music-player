<?php

require_once 'src/Models/SongsModel.php';
require_once 'src/Entities/Song.php';
require_once 'src/Services/PlayCountService.php';
require_once 'src/Services/DatabaseConnector.php';

$db = DatabaseConnector::connect();

$songId = 1;

$playButton = new SongsModel($db);
$buttonTest = $playButton->getSongsByAlbum($songId);

$playButton = UpdatePlayCount::playCount($buttonTest, $songId);
echo $playButton;
