<?php

declare(strict_types=1);

function displayAlbums(int $artistId, array $allArtists): array
{
    $albumsArray = [];
    foreach ($allArtists as $artist) {
        if ($artist['artist_id']===$artistId) {
             $albumsArray[] = $artist['album_name'];
        }
    }

    return $albumsArray;
}