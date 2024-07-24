<?php
class AlbumsModel {
    public PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAlbumById(int $id): Album
    {
        $query = $this->db->prepare('SELECT `albums`.`id` AS "albumId", `albums`.`album_name` AS "albumName",  
        `albums`.`artwork_url` AS "artworkURL", `albums`.`artist_id` AS "artistId" FROM `albums` WHERE `albums`.`id` = :id;');
        $query->setFetchMode(PDO::FETCH_CLASS, Album::class);
        $query->execute(['id' => $id]);
        return $query->fetch();
    }

    /**
     * @return Album[]
     */
    public function getAllAlbums(): array
    {
        $query = $this->db->prepare('SELECT `albums`.`id` AS "albumId", `albums`.`album_name` AS "albumName",  
        `albums`.`artwork_url` AS "artworkURL", `albums`.`artist_id` AS "artistId" FROM `albums`;');
        $query->setFetchMode(PDO::FETCH_CLASS, Album::class);
        $query->execute();
        return $query->fetchAll();
    }

    /**
     * @return Album[]
     */
    public function getAlbumsByArtistId(int $artistId): array
    {
        $query = $this->db->prepare('SELECT `albums`.`id` AS "albumId", `albums`.`album_name` AS "albumName",  
        `albums`.`artwork_url` AS "artworkURL", `albums`.`artist_id` AS "artistId" FROM `albums` 
        WHERE `artist_id` = :artistId;');
        $query->setFetchMode(PDO::FETCH_CLASS, Album::class);
        $query->execute(['artistId' => $artistId]);
        $albumsResults = $query->fetchAll();

        $songquery = $this->db->prepare("SELECT `album_id`, COUNT(`album_id`) AS 'song_count' FROM `songs` GROUP BY `album_id`;");
        $songquery->execute();
        $songresults = $songquery->fetchAll();

        foreach ($albumsResults as $album)
        {
            foreach ($songresults as $song)
            {
                if ($album->getAlbumId() === $song['album_id'])
                {
                    $album->setSongCount($song['song_count']);
                }
            }
        }
        return $albumsResults;
    }

}
