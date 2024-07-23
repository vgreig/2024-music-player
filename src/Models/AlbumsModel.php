<?php

class AlbumsModel {
    public PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAlbumById(int $id)
    {
        $query = $this->db->prepare('SELECT `albums`.`id` AS "albumId", `albums`.`album_name` AS "albumName",  
        `albums`.`artwork_url` AS "artworkURL", `albums`.`artist_id` AS "artistId" FROM `albums` WHERE `albums`.`id` = :id;');
        $query->setFetchMode(PDO::FETCH_CLASS, Album::class);
        $query->execute(['id' => $id]);
        return $query->fetch();
    }

}