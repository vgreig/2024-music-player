<?php

declare(strict_types=1);

class ArtistsModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getArtistById($id): Artist
    {
        $query = $this->db->prepare('SELECT * FROM `artists` WHERE `artists`.`id` = :id;');
        $query->setFetchMode(PDO::FETCH_CLASS, Artist::class);
        $query->execute(['id' => $id]);
        return $query->fetch();
    }

    /**
     * @return Artist[]
     */
    public function getAllArtists(): array
    {
        $artistquery = $this->db->prepare('SELECT `id`, `artist_name`
        FROM `artists`;');
        $artistquery->setFetchMode(PDO::FETCH_CLASS, Artist::class);
        $artistquery->execute();
        $artistResults = $artistquery->fetchAll();

        $albumquery = $this->db->prepare("SELECT `artist_id`, COUNT(`artist_id`) AS 'album_count' 
        FROM `albums` GROUP BY `artist_id`;");
        $albumquery->execute();
        $albumCountResults = $albumquery->fetchAll();

        foreach ($artistResults as $artist)
        {
            foreach ($albumCountResults as $album)
            {
                if ($artist->getId() === $album['artist_id'])
                {
                   $artist->setAlbumCount($album['album_count']);
                }
            }
        }
        return $artistResults;
    }
}