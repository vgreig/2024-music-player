<?php
class Album {
    private int $albumId;
    private string $albumName;
    private string $artworkURL;
    private int $artistId;

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
}
