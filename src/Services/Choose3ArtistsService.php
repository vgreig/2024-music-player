<?php

declare(strict_types=1);

class Choose3ArtistsService {

    /**
     * @param Artist[]
     * @return Artist[]
     */
    public static function choose3Artists(array $artists): array
    {
        shuffle($artists);
        $threeArtists = array_slice($artists, 0, 3);
        return $threeArtists;
    }
}
