<?php

require('vendor/autoload.php');
require_once 'src/DatabaseConnector.php';
require_once 'src/Models/ArtistsModel.php';
require_once 'src/Entities/Artist.php';

$db = DatabaseConnector::connect();

$artistsModel = new ArtistsModel($db);
$artistAlbums = new Artist();
$artists = $artistsModel->getAllArtists();
$displayArtists = $artistsModel->displayThreeArtists($artists);
$albumName = $artistAlbums->getAlbumName();
//function getAlbumCount($artists, $albumName)
//{
//    $count = 0;
//    foreach ($artists as $artist) {
//        if (
//            $albumName != $albumName
//        )
//    }
//};
var_dump($albumName);

echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Music Player</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="play.js"></script>
</head>
<body>
<div class="h-screen w-full bg-blue-950 flex text-white">
    <main class="group grow h-screen">
        <section class="group-[.minimised]:h-[calc(100%-6rem)] h-3/4 p-12 overflow-auto">
            <h2 class="text-4xl font-bold">Home</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 mt-12 gap-5">
                <div class="">
                    <h3 class="text-xl font-bold mb-3">Artists</h3>
                    <div class="grid grid-cols-2 gap-3 mb-3">';
                    foreach ($displayArtists as $artist) {
                        echo "
                        <a class='rounded bg-cyan-950 p-3 hover:bg-cyan-800 hover:cursor-pointer'>
                            <div class='flex gap-2 h-8'>
                                <img class='rounded' src='{$artist->getArtworkUrl()}' />
                                <img class='rounded' src='{$artist->getArtworkUrl()}'  />
                            </div>
                            <h4 class='text-xl font-bold'>{$artist->getArtistName()}</h4>
                            <p>3 Albums</p>
                            </a>";
                    }
                       echo '<div class="rounded bg-cyan-950 p-3 flex items-center">
                            <h4 class="text-2xl text-slate-500">+ 16 more</h4>
                        </div>
                    </div>
                    <a href="artists.html" class="float-right border rounded-md bg-cyan-950 px-2 py-1 hover:bg-cyan-800">See all
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 inline">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </a>
                </div>
</body>
</html>';








