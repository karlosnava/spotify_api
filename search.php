<?php
    require('./helpers.php');
    $q = $_GET['q'];
    $type = $_GET['type'];

    if (empty($q) || empty($type)) {
        header("Location: ./");
    }

    $response = search($type, $q);
    // echo "<pre>";
    //     print_r($response);
    // echo "</pre>";
?>
<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Resultados de búsqueda | Spotify API</title>
  <link rel="stylesheet" href="./global.css">  
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/d267b61a05.js" crossorigin="anonymous"></script>
</head>
<body class="bg-slate-900 text-white">
  <div class="w-11/12 sm:w-10/12 md:w-8/12 mx-auto my-5">
    <?php include('./partials/topbar.php'); ?>

    <h3 class="font-bold text-3xl mb-3">
    <?php
    if ($type == 'album') {
        echo "<i class='fas fa-layer-group text-orange-500'></i> Álbumes encontrados:";
    }
    if ($type == 'artist') {
        echo "<i class='fas fa-microphone-lines text-blue-500'></i> Artistas encontrados:";
    }
    if ($type == 'track') {
        echo "<i class='fas fa-music text-rose-500'></i> Pistas encontradas:";
    }
    ?>
    </h3>

    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-5">
    <?php
        if ($type == 'album') {
            foreach ($response['albums']['items'] as $album) { ?>
                <div>
                    <a href="./album.php?id=<?=$album['id'];?>">
                        <img class="w-30 h-30 rounded-md" src="<?=$album['images'][0]['url'];?>" alt="">
                    </a>
                    <div class="text-center">
                        <h4 class="font-bold text-lg line-clamp-1"><?=$album['name'];?></h4>
                    </div>
                </div>
            <?php }
        }
        if ($type == 'artist') {
            foreach ($response['artists']['items'] as $artist) { ?>
                <div>
                    <a href="./artist.php?id=<?=$artist['id'];?>">
                        <img class="min-w-32 min-h-32 max-w-32 max-h-32 mx-auto rounded-full" src="<?=$artist['images'][0]['url'];?>" alt="">
                    </a>
                    <div class="text-center">
                        <h4 class="font-bold text-lg">
                            <?=$artist['name'];?>
                            <small class="text-xs"><i class="fas fa-star text-orange-500"></i> <?=number_format($artist['popularity']);?></small>
                        </h4>
                    </div>
                </div>
            <?php }
        }
        if ($type == 'track') {
            foreach ($response['tracks']['items'] as $track) { ?>
                <div class="mb-5">
                    <a href="<?=$track['uri'];?>">
                        <img class="w-30 h-30 rounded-full" src="<?=$track['album']['images'][0]['url'];?>" alt="">
                    </a>
                    <div class="text-center line-clamp-2">
                        <h4 class="font-bold text-lg"><?=$track['name'];?></h4>
                        <?php foreach ($track['artists'] as $artist) { ?>
                            <a href="./artist.php?id=<?=$artist['id'];?>" class="text-gray-400"><?=$artist['name'];?></a> - 
                        <?php } ?>
                    </div>
                </div>
            <?php }
        }
    ?>
    </div>
</body>
</html>