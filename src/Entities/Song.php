<?php

declare(strict_types=1);

class Song {
    private string $songName;
    private float $length;
    private ?int $playCount;

    public function getSongName(): string
    {
        return $this->songName;
    }

    public function getLength(): float
    {
        return $this->length;
    }

    public function getPlayCount(): int
    {
        if (gettype($this->playCount) === 'NULL'){
            $this->playCount = 0;
        }
        return $this->playCount;
    }


}