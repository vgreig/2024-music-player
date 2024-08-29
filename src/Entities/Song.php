<?php

declare(strict_types=1);

class Song
{
    private string $songName;
    private float $length;
    private ?int $playCount;
    private int $favourite;
    private int $songId;
    private string $timePlayed;
    private string $artistName;
    private int $artistId;

    public function setSongName(string $songName): void
    {
        $this->songName = $songName;
    }
    private int $albumId;

    public function getAlbumId(): int
    {
        return $this->albumId;
    }

    public function getArtistName(): string
    {
        return $this->artistName;
    }

    public function getArtistId(): int
    {
        return $this->artistId;
    }

    public function getTimePlayed(): string
    {
        return $this->timePlayed;
    }

    public function getFavourite(): int
    {
        return $this->favourite;
    }

    public function getSongId(): int
    {
        return $this->songId;
    }

//    public function __construct(string $songName = '', float $length = 0, ?int $playCount = 0, int $favourite = 0, int $songId = 0, string $timePlayed = '')
//    {
//        $this->songName = $songName;
//        $this->length = $length;
//        $this->playCount = $playCount;
//        $this->favourite = $favourite;
//        $this->songId = $songId;
//        $this->timePlayed = $timePlayed;
//    }

    public function getSongName(): string
    {
        return $this->songName;
    }

    public function getLength(): string
    {
        return number_format($this->length, 2, ':', ',');
    }

    public function getPlayCount(): int
    {
        if (gettype($this->playCount) === 'NULL') {
            $this->playCount = 0;
        }
        return $this->playCount;
    }

}
    