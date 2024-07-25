<?php

declare(strict_types=1);

class DisplayFartistService {
    public static function displayFartistSongs(array $favArtists, SongsModel $songModel): string
    {
        $output= '';
        foreach ($favArtists as $fartist){


            $faveSongs = $songModel->getFavouriteSongsByArtist($fartist->getId());

            $output .= $fartist->getArtistName() . " ";

            foreach($faveSongs as $song){
                $output.= $song->getSongName()." ".$song->getPlayCount()." ".$song->getLength();
            }
        }

        echo $output;
    }
}