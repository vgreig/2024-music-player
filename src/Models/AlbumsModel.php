<?php

declare(strict_types=1);

class AlbumsModel {
    public PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
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

    /**
     * @return Album[]
     */
    public function getPopularAlbums(): array
    {
        $query = $this->db->prepare("SELECT `albums`.`id` AS 'albumId', `albums`.`album_name` AS 'albumName', `artists`.`artist_name` AS 'albumArtist', `albums`.`artwork_url` AS 'artworkURL', `artists`.`id` AS 'artistId',
            SUM(`songs`.`play_count`) AS 'totalPlayCount'
            FROM `albums`
            INNER JOIN
            `songs`ON `albums`.`id` = `songs`.`album_id`
            INNER JOIN `artists` ON `artists`.`id` = `albums`.`artist_id`
            GROUP BY `albums`.`id`, `albums`.`album_name`
            ORDER BY `totalPlayCount` DESC
            LIMIT 5;");
        $query->setFetchMode(PDO::FETCH_CLASS, Album::class);
        $query->execute();
        return $query->fetchAll();
    }
}

