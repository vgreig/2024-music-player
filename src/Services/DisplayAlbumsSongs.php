<?php

declare(strict_types=1);

class DisplayAlbumsSongs {
    public static function displayAlbums(array $artistsAlbums, SongsModel $songs): string
    {
        $albums = '';
        foreach ($artistsAlbums as $singleAlbum) {
            $albums .= "
                        <div class='rounded p-3 bg-cyan-950'>
                        <h4 class='mb-3 text-2xl font-bold'>{$singleAlbum->getAlbumName()}</h4>
                        ";
            $songsInAlbum = $songs->getSongsByAlbum($singleAlbum->getAlbumId());
            foreach ($songsInAlbum as $songInAlbum) {
                $albums .= "
                    <div class='mx-3 mb-3 flex justify-between items-center'>
                        <div class='w-3/4 pe-3'>
                            <h4 class='font-bold text-lg'>{$songInAlbum->getSongName()}</h4>
                            <p class='text-sm'>Played {$songInAlbum->getPlayCount()} times</p>
                        </div>
                        <div class='flex items-center justify-between w-24'>
                            <span class='text-slate-500'>{$songInAlbum->getLength()}</span>
                                        
                            <a href='?playSong=1' class='hover:text-slate-500 hover:cursor-pointer'>
                                <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6 inline'>
                                    <path stroke-linecap='round' stroke-linejoin='round' d='M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z'></path>
                                    <path stroke-linecap='round' stroke-linejoin='round' d='M15.91 11.672a.375.375 0 0 1 0 .656l-5.603 3.113a.375.375 0 0 1-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112Z'></path>
                                </svg>
                            </a>
                            <a href='?&songId={$songInAlbum->getSongId()}' class='hover:text-slate-500 hover:cursor-pointer'>
                                <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6'>
                                    <path stroke-linecap='round' stroke-linejoin='round' d='M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z' />
                                </svg>
                            </a>
                        </div>
                    </div>";}
            $albums .= "</div>";
        }

        return $albums;
    }
}
