<?php

class Album {
    private int $albumId;
    private string $albumName;
    private string $artworkURL;
    private int $artistId;
    private int $song_count;
    private string $albumArtist;
    private int $totalPlayCount;

    public function getAlbumArtist(): string
    {
        return $this->albumArtist;
    }

    public function getTotalPlayCount(): int
    {
        return $this->totalPlayCount;
    }

    public function getAlbumId(): int
    {
        return $this->albumId;
    }

    public function getAlbumName(): string
    {
        return $this->albumName;
    }

    public function getArtworkURL(): string
    {
        return $this->artworkURL;
    }

    public function getArtistId(): int
    {
        return $this->artistId;
    }

    public function getSongCount(): int
    {
        return $this->song_count;
    }

    public function setSongCount(int $song_count): void
    {
        $this->song_count = $song_count;
    }
}

