<?php
  require('./helpers.php');
  
  if (isset($_GET['id']) && !empty($_GET['id'])) {
    $album = getAlbum($_GET['id']);
  } else {
    return "Álbum no encontrado.";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=$album['name'];?> | Spotify API</title>
  <link rel="stylesheet" href="./global.css">  
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/d267b61a05.js" crossorigin="anonymous"></script>
</head>
<body class="bg-slate-900 text-white">
  <div class="w-11/12 sm:w-10/12 md:w-8/12 mx-auto my-5">
    <?php include('./partials/topbar.php'); ?>

    <div class="flex">
        <img class="w-80 h-80 rounded-3xl" src="<?=$album['images'][0]['url'];?>" alt="">
        <div class="mx-8">
            <h1 class="font-bold text-4xl"><?=$album['name'];?></h1>
            <div class="flex items-center mt-5">
                <?php foreach ($album['artists'] as $artist) { ?>
                    <a href="./artist.php?id=<?=$artist['id'];?>" class="text-gray-400"><?=$artist['name'];?></a>, 
                <?php } ?>
            </div>
            <div class="text-gray-400 mb-4">Fecha de lanzamiento: <?=$album['release_date'];?></div>
            <a href="<?=$album['uri'];?>" target="_blank" class="text-green-500 border border-green-500 rounded-md px-4 py-2 transition hover:bg-green-500 hover:text-white">
                <i class="fa-brands fa-spotify"></i> Abrir en Spotify
            </a>
        </div>
    </div>

    <h3 class="font-bold text-3xl mb-3 mt-10"><i class="fas fa-music text-rose-500"></i> Pistas (<?=$album['tracks']['total'];?>)</h3>
    <?php foreach ($album['tracks']['items'] as $track) {
        $ms = $track['duration_ms']; ?>
        <a href="<?=$track['uri'];?>" class="flex items-center justify-between rounded-xl px-3 py-2 hover:bg-slate-500">
            <div class="flex items-center">
                <span class="text-gray-400"><?=$track['track_number'];?>.</span>
                <div class="font-semibold ml-3"><?=$track['name'];?></div>
            </div>
            <?=floor($ms/60000).':'.str_pad(floor(($ms%60000)/1000), 2, 0, STR_PAD_LEFT);?>
        </a>
        <hr class="border-gray-700 my-1">
    <?php } ?>
  </div>
</body>
</html>