<?php
  require('./helpers.php');
  
  if (isset($_GET['id']) && !empty($_GET['id'])) {
    $artist = getArtist($_GET['id']);
    $albums = getArtistAlbums($_GET['id']);
  } else {
    return "Artista no encontrado.";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=$artist['name'];?> | Spotify API</title>
  <link rel="stylesheet" href="./global.css">  
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/d267b61a05.js" crossorigin="anonymous"></script>
</head>
<body class="bg-slate-900 text-white p-5">
  <div class="w-11/12 sm:w-10/12 md:w-8/12 mx-auto my-5">
    <?php include('./partials/topbar.php'); ?>

    <div class="flex items-center">
      <img class="w-52 h-52 rounded-full" src="<?=$artist['images'][0]['url'];?>" alt="">

      <div class="mx-8 mb-5">
        <h1 class="font-bold text-5xl">
          <?=$artist['name'];?>
          <small class="text-xs"><i class="fas fa-star text-orange-500"></i> <?=number_format($artist['popularity']);?></small>
        </h1>
        <div class="mt-3">
          <div class="text-gray-400 mb-4"><?=number_format($artist['followers']['total']);?> seguidores</div>
          <a href="<?=$artist['uri'];?>" target="_blank" class="text-xs text-green-500 border border-green-500 rounded-md px-4 py-2">
            <i class="fa-brands fa-spotify"></i> Abrir en Spotify
          </a>
        </div>
        <div class="mt-5">
          <h3 class="font-bold mb-1">Géneros</h3>
          <?php foreach($artist['genres'] as $genre) { ?>
            <span class="border text-xs rounded-full px-4 py-1 mr-1"><?=$genre;?></span>
          <?php } ?>
        </div>
      </div>
    </div>

    <h3 class="font-bold text-3xl mb-3 mt-10"><i class="fa-solid fa-layer-group text-orange-500"></i> Álbumes (<?=$albums['total'];?>)</h3>
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
      <?php foreach($albums['items'] as $album) { ?>
        <div class="rounded-3xl shadow-md p-2 bg-purple-500">
          <a href="./album.php?id=<?=$album['id'];?>">
            <img class="rounded-3xl transition hover:scale-105" src="<?=$album['images'][0]['url'];?>" alt="">
          </a>
          <div class="text-center leading-5 mt-3">
            <h4 class="font-semibold"><?=$album['name'];?></h4>
            <?php foreach ($album['artists'] as $artist) { ?>
              <a href="./artist.php?id=<?=$artist['id'];?>" class="text-gray-200"><?=$artist['name'];?></a> - 
            <?php } ?>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</body>
</html>