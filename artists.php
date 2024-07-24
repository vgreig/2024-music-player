<?php
require('vendor/autoload.php');
require_once 'src/DatabaseConnector.php';
require_once 'src/Models/ArtistsModel.php';
require_once 'src/Entities/Artist.php';
require_once 'src/Entities/Album.php';
require_once 'src/Models/AlbumsModel.php';


$db = DatabaseConnector::connect();

$artistsModel = new ArtistsModel($db);
$artist = new Artist();
$artists = $artistsModel->getAllArtists();
$albumsModel = new AlbumsModel($db);

echo'<pre>';
//var_dump($albums);
echo'</pre>';
//var_dump($albumByArtist);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Music Player</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="play.js"></script>
</head>
<body>
<div class="h-screen w-full bg-blue-950 flex text-white">
    <main class="group grow h-screen">
        <section class="group-[.minimised]:h-[calc(100%-6rem)] h-3/4 p-12 overflow-auto">
            <div class="flex justify-between">
                <h2 class="text-4xl font-bold mb-6">Artists</h2>
                <a href="index.html" class="align-top">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                    </svg>
                    back
                </a>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5 items-start">

                <?php
                    $artistLoop = '';
                    foreach ($artists as $artist) {
                    $artistLoop .= "
                        <div class='rounded p-3 bg-cyan-950'>
                        <h4 class='mb-3 text-2xl font-bold'>{$artist->getArtistName()}</h4>";

                    $albums = $albumsModel->getAlbumsByArtistId($artist->getId());
                    foreach ($albums as $album) {
                        $artistLoop .= "
                    <div class='mb-3 flex justify-between items-center'>
                        <img class='' src='{https://via.placeholder.com/50x50/386641/6A994E?text=The+Memory+of+Trees}' />
                        <div class='w-3/4 px-3'>
                            <h4 class='font-bold text-lg'>{$album->getAlbumName()}</h4>
                            <p class='text-sm'>{$album->getSongCount()} songs</p>
                        </div>
                        <a href='artist.html' class='hover:text-slate-500 hover:cursor-pointer'>
                            <svg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke-width='1.5' stroke='currentColor' class='size-6'>
                                <path stroke-linecap='round' stroke-linejoin='round' d='m12.75 15 3-3m0 0-3-3m3 3h-7.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z' />
                            </svg>
                        </a>
                    </div>"; }
                $artistLoop .= "</div>";
                }
                    echo $artistLoop;
                    ?>
            </div>
        </section>
        <section class="group-[.minimised]:py-2 group-[.minimised]:h-24 h-1/4 border-t bg-cyan-950 border-slate-500 p-6">
            <div class="group-[.minimised]:hidden flex justify-between mb-5">
                <h3 class="text-2xl">Now Playing</h3>
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m9 9 10.5-3m0 6.553v3.75a2.25 2.25 0 0 1-1.632 2.163l-1.32.377a1.803 1.803 0 1 1-.99-3.467l2.31-.66a2.25 2.25 0 0 0 1.632-2.163Zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 0 1-1.632 2.163l-1.32.377a1.803 1.803 0 0 1-.99-3.467l2.31-.66A2.25 2.25 0 0 0 9 15.553Z" />
                    </svg>
                </div>
            </div>
            <div class="flex justify-between items-start md:items-stretch">
                <img src="https://via.placeholder.com/400x400/386641/6A994E?text=The+Memory+of+Trees" class="group-[.minimised]:hidden hidden sm:block w-20 md:w-32 mr-5" alt="album cover" />
                <div class="flex justify-between flex-wrap grow content-between">
                    <div class="group-[.minimised]:hidden w-full md:w-auto">
                        <h4 class="text-xl">Song title</h4>
                        <h5>Artist</h5>
                    </div>
                    <div class="group-[.minimised]:w-full group-[.minimised]:p-0 group-[.minimised]:m-0 group-[.minimised]:mb-2 flex justify-between w-full md:w-1/2 md:mr-12 pr-8 pt-3 mb-3">
                        <button class="hover:text-slate-500" id="playPrev">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 16.811c0 .864-.933 1.406-1.683.977l-7.108-4.061a1.125 1.125 0 0 1 0-1.954l7.108-4.061A1.125 1.125 0 0 1 21 8.689v8.122ZM11.25 16.811c0 .864-.933 1.406-1.683.977l-7.108-4.061a1.125 1.125 0 0 1 0-1.954l7.108-4.061a1.125 1.125 0 0 1 1.683.977v8.122Z" />
                            </svg>
                        </button>
                        <button class="hover:text-slate-500" id="play">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-9">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 7.5V18M15 7.5V18M3 16.811V8.69c0-.864.933-1.406 1.683-.977l7.108 4.061a1.125 1.125 0 0 1 0 1.954l-7.108 4.061A1.125 1.125 0 0 1 3 16.811Z" />
                            </svg>
                        </button>
                        <button class="hover:text-slate-500" id="playNext">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8.689c0-.864.933-1.406 1.683-.977l7.108 4.061a1.125 1.125 0 0 1 0 1.954l-7.108 4.061A1.125 1.125 0 0 1 3 16.811V8.69ZM12.75 8.689c0-.864.933-1.406 1.683-.977l7.108 4.061a1.125 1.125 0 0 1 0 1.954l-7.108 4.061a1.125 1.125 0 0 1-1.683-.977V8.69Z" />
                            </svg>
                        </button>
                    </div>
                    <div class="w-full flex justify-between">
                        <div class="mr-6" id="playTime">0:00</div>
                        <div class="bg-white rounded-md w-full h-6 overflow-hidden mr-6">
                            <div class="bg-blue-500 w-0 h-full" id="playProgress"></div>
                        </div>
                        <button class="hover:text-slate-500" id="repeat">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-7">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
</body>
</html>
