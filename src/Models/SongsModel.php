<?php

declare(strict_types=1);

require_once 'src/Entities/Song.php';

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
        $query = $this->db->prepare('SELECT `songs`.`id` AS "songId", `songs`.`song_name` AS "songName", `songs`.`length`,
        `songs`.`play_count` AS "playCount", `songs`.`favourite` FROM `songs` INNER JOIN `albums` ON `songs`.`album_id` = `albums`.`id` 
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

    public function updateFavouriteStatus(int $id): bool
    {
        $query = $this->db->prepare('UPDATE `songs` SET `favourite` = NOT `favourite` WHERE `id` = :id;');
        return $query->execute(['id' => $id]);
    }

    /**
     * @return Song[]
     */
    public function getFavouriteSongsByArtist(int $artistId): array
    {
        $query = $this->db->prepare('SELECT `songs`.`song_name` AS "songName", `songs`.`play_count` AS "playCount", 
       `songs`.`length`, `songs`.`id` AS "songId", `songs`.`favourite`
        FROM `songs`
        INNER JOIN `albums` ON `songs`.`album_id` = `albums`.`id`
        INNER JOIN `artists` ON `artists`.`id` = `albums`.`artist_id`
        WHERE `songs`.`favourite` = 1
        AND `artists`.`id` = :artistId;');
        $query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Song::class);
        $query->execute(['artistId' => $artistId]);
        return $query->fetchAll();
    }

    public function updatePlayCount(int $songId): bool
    {
        $query = $this->db->prepare('UPDATE `songs`
                                            SET `play_count` = `play_count` + 1
                                            WHERE `songs`.`id` = :songId');
        return $query->execute(['songId' => $songId]);
    }

    /**
     * @return Song[]
     */
    public function getRecentlyPlayed(): array
    {
        $query = $this->db->prepare('SELECT `songs`.`id` AS "songId", `songs`.`song_name` AS "songName", `artist_name` AS "artistName", `length`, `album_id` AS "albumId", `play_count` AS "playCount", `time_played` AS "timePlayed",`favourite`,`artists`.`id` AS "artistId"
            FROM `albums`
            INNER JOIN `artists`
            ON `artist_id` = `artists`.`id`
            INNER JOIN `songs`
            ON `albums`.`id` = `album_id`
            WHERE `time_played` > 0
            ORDER BY `time_played` DESC LIMIT 3;');
        $query->setFetchMode(PDO::FETCH_CLASS, Song::class);
        $query->execute([]);
        return $query->fetchAll();
    }

    public function updateTimePlayed(int $songId): bool
    {
        $query = $this->db->prepare("UPDATE `songs`
            SET `time_played` = CURRENT_TIMESTAMP
            WHERE `id` = :songId;");
        return $query->execute(['songId'=>$songId]);
    }

    public function searchSongName(string $search): array
    {
        $query = $this->db->prepare('SELECT `songs`.`id` AS "songId", `songs`.`song_name` AS "songName", `artist_name` AS "artistName", `length`, `album_id` AS "albumId", `play_count` AS "playCount", `time_played` AS "timePlayed",`favourite`,`artists`.`id` AS "artistId"
            FROM `albums`
            INNER JOIN `artists`
            ON `artist_id` = `artists`.`id`
            INNER JOIN `songs`
            ON `albums`.`id` = `album_id`
            WHERE `song_name` LIKE :search
            ORDER BY `artist_name`;');
        $query->setFetchMode(PDO::FETCH_CLASS, Song::class);
        $query->execute(['search'=> "%$search%"]);
        return $query->fetchAll();
    }
}
