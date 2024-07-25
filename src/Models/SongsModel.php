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

    public function getSongsByAlbum(int $id): array
    {
        $query = $this->db->prepare('SELECT `songs`.`song_name` AS "songName", `songs`.`length`, 
        `songs`.`play_count` AS "playCount" FROM `songs` INNER JOIN `albums` ON `songs`.`album_id` = `albums`.`id` 
        WHERE `albums`.`id` = :id;');
        $query->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, Song::class);
        $query->execute(['id' => $id]);
        return $query->fetchAll();
    }

    public function getSongsAndAlbumByAlbum(int $id): array
    {
        $query = $this->db->prepare('SELECT `songs`.`song_name` AS "songName", `songs`.`length`, 
        `songs`.`play_count` AS "playCount" FROM `songs` INNER JOIN `albums` ON `songs`.`album_id` = `albums`.`id` 
        WHERE `albums`.`id` = :id;');
        $query->setFetchMode(PDO::FETCH_CLASS, Song::class);
        $query->execute(['id' => $id]);
        return $query->fetchAll();
    }

    public function updateFavouriteStatus(int $id): int
    {
        $query = $this->db->prepare('UPDATE `songs` SET `favourite` = NOT `favourite` WHERE `id` = :id;');
        return $query->execute(['id' => $id]);
        }
}