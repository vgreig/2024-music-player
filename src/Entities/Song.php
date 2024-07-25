<?php

declare(strict_types=1);

class Song {
    private string $songName;
    private float $length;
    private ?int $playCount;
    private int $favourite;
    private int $songId;

    public function getFavourite(): int
    {
        return $this->favourite;
    }

    public function getSongId(): int
    {
        return $this->songId;
    }

    public function __construct(string $songName = '', float $length = 0, ?int $playCount = 0)
    {
        $this->songName = $songName;
        $this->length = $length;
        $this->playCount = $playCount;
    }

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
        if (gettype($this->playCount) === 'NULL'){
            $this->playCount = 0;
        }
        return $this->playCount;
    }


}