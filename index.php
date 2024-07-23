<?php

require_once 'src/Models/SongsModel.php';
require_once 'src/Services/DatabaseConnector.php';
require_once 'src/Entities/Song.php';
require_once 'src/Models/ArtistsModel.php';
require_once 'src/Entities/Artist.php';
require_once 'src/Services/DisplayArtistsAlbums.php';
require_once 'src/Models/AlbumsModel.php';
require_once 'src/Entities/Album.php';

$db = DatabaseConnector::connect();

$artistId = 1;

$artists = new ArtistsModel($db);
$artist = $artists->getArtistById($artistId);

$songs = new SongsModel($db);

$albums = new AlbumsModel($db);
$artistsAlbums = $albums->getAlbumsByArtistId($artistId);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Music Player</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="play.js"></script>
</head>
<div class="h-screen w-full bg-blue-950 flex text-white">
    <main class="group grow h-screen">
        <section class="group-[.minimised]:h-[calc(100%-6rem)] h-3/4 p-12 overflow-auto">
            <div class="flex justify-between">
                <h2 class="text-4xl font-bold mb-6"><?php echo $artist->getArtistName(); ?></h2>
                <a href="artists.html" class="align-top">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                    </svg>
                </a>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5 items-start">
                <?php
                $albums = DisplayArtistsAlbums::displayAlbums($artistsAlbums, $songs);
                echo $albums;
                ?>
            </div>
        </section>
    </main>
</div>


</html>

