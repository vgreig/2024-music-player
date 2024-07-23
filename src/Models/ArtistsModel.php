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
        $artistquery = $this->db->prepare('SELECT `artists`.`id`, `artists`.`artist_name`, `albums`.`id`, `albums`.`album_name`, `albums`.`artwork_url`, `albums`.`artist_id`,`songs`.`album_id`,`songs`.`id` AS `song_id`
        FROM `albums`
        INNER JOIN `artists`
        ON `artists`.`id` = `albums`.`artist_id`
        INNER JOIN `songs`
        ON `albums`.`id` = `songs`.`album_id`;');
        $artistquery->setFetchMode(PDO::FETCH_CLASS, Artist::class);
        $artistquery->execute();
        return $artistquery->fetchAll();

        $albumquery = $this->db->prepare("SELECT `artist_id`, COUNT(`artist_id`) AS 'album_count' 
        FROM `albums` GROUP BY `artist_id`;");
        $albumquery->execute();
        return $albumquery->fetchAll();
    }

    public function displayThreeArtists($artists)
    {
        shuffle($artists);
        $threeArtists = array_slice($artists, 0, 3);
        return $threeArtists;
    }
}
