<?php

require_once 'src/Models/SongsModel.php';
require_once 'src/Services/DatabaseConnector.php';
require_once 'src/Entities/Song.php';

$db = DatabaseConnector::connect();

$songs = new SongsModel($db);
$songsInAlbum = $songs->getSongsByAlbum(2);

echo '<pre>';
var_dump($songsInAlbum);
echo '</pre>';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Music Player</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="play.js"></script>
</head>


<div class="h-screen w-full bg-blue-950 flex text-white">

    <main class="group grow h-screen">
        <section class="group-[.minimised]:h-[calc(100%-6rem)] h-3/4 p-12 overflow-auto">
            <div class="flex justify-between">
                <!--   ARTIST NAME             -->
                <h2 class="text-4xl font-bold mb-6">Artist name</h2>
                <a href="artists.html" class="align-top">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                    </svg>
                    back
                </a>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5 items-start">

                <div class="rounded p-3 bg-cyan-950">
                    <!--ALBUM NAME-->
                    <h4 class="mb-3 text-2xl font-bold">Album name</h4>
                    <div class="mx-3 mb-3 flex justify-between items-center">
                        <div class="w-3/4 pe-3">
                            <!--SONG NAME-->
                            <h4 class="font-bold text-lg">Song name</h4>
                            <!--PLAY NUMBER-->
                            <p class="text-sm">Played 4 times</p>
                        </div>
                        <div class="flex items-center justify-between w-24">
                            <!--LENGTH-->
                            <span class="text-slate-500">3:36</span>
                            <a href="?playSong=1" class="hover:text-slate-500 hover:cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 inline">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.91 11.672a.375.375 0 0 1 0 .656l-5.603 3.113a.375.375 0 0 1-.557-.328V8.887c0-.286.307-.466.557-.327l5.603 3.112Z"></path>
                                </svg>
                            </a>
                            <a href="favourite.php?id=" class="hover:text-slate-500 hover:cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>
</div>


</html>

