<?php
require_once 'src/DatabaseConnector.php';

class ArtistsModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllArtists()
    {
        $artistquery = $this->db->prepare('SELECT `artists`.`id`, `artists`.`artist_name`, `albums`.`album_name`, `albums`.`artwork_url`, `albums`.`artist_id`,`songs`.`album_id`,`songs`.`id` AS `song_id`
        FROM `albums`
        INNER JOIN `artists`
        ON `artists`.`id` = `albums`.`artist_id`
        INNER JOIN `songs`
        ON `albums`.`id` = `songs`.`album_id`;');
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

    public function displayThreeArtists($artistResults)
    {
        shuffle($artistResults);
        $threeArtists = array_slice($artistResults, 0, 3);
        return $threeArtists;
    }

    public function getArtistAlbums($artistId)
    {
        $artistalbums = $this->db->prepare("
        SELECT `artists`.`id`, `artists`.`artist_name`, `albums`.`album_name`, `albums`.`artist_id`, `albums`.`id` AS 'album_id'
		FROM `artists`
		INNER JOIN `albums`
		ON `artists`.`id` = `albums`.`artist_id`
        WHERE `albums`.`artist_id` = :artistId;");
        $artistalbums->setFetchMode(PDO::FETCH_CLASS, Artist::class);
        $artistalbums->execute(['artistId' => $artistId]);
        $albumsResults = $artistalbums->fetchAll();

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

//    public function getAlbumsByArtistId()
//    {
//
//    }

}

// `songs`.`id` AS 'song_id', `songs`.`album_id`,
// INNER JOIN `songs` ON `songs`. `album_id` = `albums`.`id`