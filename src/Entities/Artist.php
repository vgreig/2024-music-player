<?php

class Artist {
    private int $id;
    private string $artist_name;
    private int $album_count;

    public function getId(): int
    {
        return $this->id;
    }

    public function getArtistName(): string
    {
        return $this->artist_name;
    }

    public function getAlbumCount(): int
    {
        return $this->album_count;
    }

    public function setAlbumCount(int $album_count): void
    {
        $this->album_count = $album_count;
    }
}
