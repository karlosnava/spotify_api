<?php
  require('./helpers.php');
?>

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inicio | Spotify API</title>
  <link rel="stylesheet" href="./global.css">  
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://kit.fontawesome.com/d267b61a05.js" crossorigin="anonymous"></script>
</head>
<body class="bg-slate-900 text-white">
  <div class="w-11/12 sm:w-10/12 md:w-8/12 mx-auto my-5">
    <?php include('./partials/topbar.php'); ?>

    <div class="mt-10">
      <h3 class="font-bold text-3xl mb-3">Álbumes</h3>

      <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3">
        <?php
        $new_releases = getNewReleases();
        foreach ($new_releases['albums']['items'] as $release) { ?>
          <div class="rounded-3xl shadow-md p-2 pb-4 bg-purple-500">
            <a href="./album.php?id=<?=$release['id'];?>">
              <img class="rounded-3xl transition hover:scale-105" src="<?=$release['images'][0]['url'];?>">
            </a>
            <div class="text-center leading-5 mt-3">
              <h4 class="font-semibold text-shadow"><?=$release['name'];?></h4>

              <?php foreach ($release['artists'] as $artist) { ?>
                <a href="./artist.php?id=<?=$artist['id'];?>" class="text-gray-200"><?=$artist['name'];?></a> - 
              <?php } ?>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</body>
</html>