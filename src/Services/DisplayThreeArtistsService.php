<?php

declare(strict_types=1);

class DisplayThreeArtistsService
{
    public static function displayThreeArtistsService(array $displayArtists, AlbumsModel $albumsModel): string
    {
        $threeArtists = '';
        foreach ($displayArtists as $artist) {
            $albums = $albumsModel->getAlbumsByArtistId($artist->getId());
            $threeArtists .= "<a href='artist.php?id={$artist->getId()}' class='rounded-md border-2 border-white p-3 relative float-left -mr-[100%] w-full transition-transform duration-[200ms] ease-in-out motion-reduce:transition-none hover:bg-slate-500 hover:cursor-pointer'>
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
