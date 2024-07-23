<?php

class Artist {
    private int $id;
    private string $artist_name;
    private int $album_id;
    private string $album_name;
    private string $artwork_url;
    private int $artist_id;
    private int $song_id;

    public function getId(): int
    {
        return $this->id;
    }

    public function getArtistName(): string
    {
        return $this->artist_name;
    }

    public function getAlbumId(): int
    {
        return $this->album_id;
    }

    public function getAlbumName(): string
    {
        return $this->album_name;
    }

    public function getArtworkUrl(): string
    {
        return $this->artwork_url;
    }

    public function getArtistId(): int
    {
        return $this->artist_id;
    }

    public function getSongId(): int
    {
        return $this->song_id;
    }
}