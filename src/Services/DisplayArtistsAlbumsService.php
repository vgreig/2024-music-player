<?php

declare(strict_types=1);

require_once 'src/Services/PlayCountService.php';

class DisplayArtistsAlbumsService {
    public static function displayArtistsAlbums(array $artists, AlbumsModel $albumsModel): string
    {
        $artistLoop = '';
        foreach ($artists as $artist) {
            $artistLoop .= "<div class='rounded p-3 bg-cyan-950'>
                        <h4 class='mb-3 text-2xl font-bold'>{$artist->getArtistName()}</h4>";

            $albums = $albumsModel->getAlbumsByArtistId($artist->getId());
            foreach ($albums as $album) {
                $artistLoop .= "
                    <div class='mb-3 flex justify-between items-center'>
                        <img class='size-14' src='{$album->getArtworkURL()}' />
                        <div class='w-3/4 px-3'>
                            <h4 class='font-bold text-lg'>{$album->getAlbumName()}</h4>
                            <p class='text-sm'>{$album->getSongCount()} songs</p>
                        </div>
                        <a href='artist.php?id={$artist->getId()}' class='hover:text-slate-500 hover:cursor-pointer'>
                            <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6'>
                                <path stroke-linecap='round' stroke-linejoin='round' d='m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z' />
                            </svg>
                        </a>
                    </div>"; }
            $artistLoop .= "</div>";
        }
        return $artistLoop;
    }
}