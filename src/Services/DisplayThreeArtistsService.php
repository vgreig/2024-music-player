<?php

declare(strict_types=1);

class DisplayThreeArtistsService
{
    public static function displayThreeArtistsService(array $displayArtists, AlbumsModel $albumsModel): string
    {
        $threeArtists = '';
        foreach ($displayArtists as $artist) {
            $albums = $albumsModel->getAlbumsByArtistId($artist->getId());
            $threeArtists .= "<a href='artist.php?id={$artist->getId()}' class='rounded bg-cyan-950 p-3 hover:bg-cyan-800 hover:cursor-pointer'>
                        <div class='flex gap-2 h-8'>";
            $counter = 0;
            foreach ($albums as $album) {
                if ($counter === 2) {
                    break;
                }
                $threeArtists .= "<img class='rounded' src='{$album->getArtworkUrl()}' />";
                $counter++;
            }
            $threeArtists .= "</div>
                     <h4 class='text-xl font-bold'>{$artist->getArtistName()}</h4>
                      <p>{$artist->getAlbumCount()} Albums</p>
                     </a>";
        }
        return $threeArtists;
    }
}
