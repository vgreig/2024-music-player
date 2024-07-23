<?php

class ArtistsModel {
    private PDO $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllArtists(): array {
        $query = $this->db->prepare('SELECT `artists`.`id`, `artists`.`artist_name`, `albums`.`id`, `albums`.`album_name`, `albums`.`artwork_url`, `albums`.`artist_id`,`songs`.`album_id`,`songs`.`id` AS `song_id`
        FROM `albums`
        INNER JOIN `artists`
        ON `artists`.`id` = `albums`.`artist_id`
        INNER JOIN `songs`
        ON `albums`.`id` = `songs`.`album_id`;');
        $query->setFetchMode(PDO::FETCH_CLASS, Artist::class);
        $query->execute();
        return $query->fetchAll();
    }

    public function displayThreeArtists($artists) {
        shuffle($artists);
        $threeArtists = array_slice($artists, 0, 3);
        return $threeArtists;
    }

    public function getArtistAlbum() {
        $query = $this->db->prepare('SELECT `artists`.`id`, `artists`.`artist_name`, `albums`.`album_name`, `albums`.`artist_id`
		FROM `artists`
		INNER JOIN `albums`
		ON `artists`.`id` = `albums`.`artist_id`;');
        //$query->setFetchMode(PDO::FETCH_CLASS, Artist::class);
        $query->execute();
        return $query->fetchAll();
    }

//    public function getArtistById()
//    {
//        $query = $this->db->prepare();
//        $query->execute();
//        return $query->fetch();
//    }
}