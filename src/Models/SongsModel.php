<?php

declare(strict_types=1);

class SongsModel {
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAlbumWithAllSongs(): array
    {
        $query = $this->db->prepare('SELECT * FROM `songs`
	    INNER JOIN `albums` ON `songs`.`album_id` = `albums`.`id`;');
        $query->execute();
        return $query->fetchAll();
    }
}