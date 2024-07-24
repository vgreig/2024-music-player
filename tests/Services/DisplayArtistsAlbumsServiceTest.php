<?php

require_once 'src/Models/ArtistsModel.php';
require_once 'src/Entities/Artist.php';
require_once 'src/Entities/Album.php';
require_once 'src/Models/AlbumsModel.php';
require_once 'src/Services/DisplayArtistsAlbumsService.php';

use PHPUnit\Framework\TestCase;

class DisplayArtistsAlbumsServiceTest extends TestCase {
    public function testDisplayArtists(): void
    {
        $artistMock = $this->createMock(Artist::class);
        $artistMock->method('getArtistName')->willReturn('bob');
        $artistMock->method('getId')->willReturn(6);

        $albumMock = $this->createMock(Album::class);
        $albumMock->method('getArtworkURL')->willReturn('www.google.com');
        $albumMock->method('getAlbumName')->willReturn('beyonce');
        $albumMock->method('getSongCount')->willReturn(2);

        $albumsModelMock = $this->createMock(AlbumsModel::class);
        $albumsModelMock->method('getAlbumsByArtistId')->willReturn([$albumMock]);

        $result = DisplayArtistsAlbumsService::displayArtistsAlbums([$artistMock], $albumsModelMock);

        $expected = "<div class='rounded p-3 bg-cyan-950'>
                        <h4 class='mb-3 text-2xl font-bold'>bob</h4>
                    <div class='mb-3 flex justify-between items-center'>
                        <img class='size-14' src='www.google.com' />
                        <div class='w-3/4 px-3'>
                            <h4 class='font-bold text-lg'>beyonce</h4>
                            <p class='text-sm'>2 songs</p>
                        </div>
                        <a href='artist.php?id=6' class='hover:text-slate-500 hover:cursor-pointer'>
                            <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6'>
                                <path stroke-linecap='round' stroke-linejoin='round' d='m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z' />
                            </svg>
                        </a>
                    </div></div>";

        $this->assertEquals($expected, $result);
    }
}
