<a href="./" class="flex items-center mb-5">
    <img class="w-16" src="https://static.vecteezy.com/system/resources/thumbnails/023/986/935/small_2x/spotify-logo-spotify-logo-transparent-spotify-icon-transparent-free-free-png.png" alt="">
    <span class="font-semibold text-lg"> | Spotify API</span>
</a>

<div class="flex items-center justify-between mb-10">
    <div class="flex items-center">
        <form action="./search.php" method="GET">
            <input type="text" name="q" placeholder="Buscar..." value="<?php if(isset($_GET['q'])) { echo $_GET['q']; } ?>" class="bg-slate-700 rounded-l-full outline-none border-0 px-5 py-3" required><select name="type" class="bg-slate-700" style="padding: 13.5px 5px;" required>
                <option value="album" <?php if(isset($_GET['type']) && $_GET['type'] == 'album') { echo 'selected'; } ?>>Álbumes</option>
                <option value="artist" <?php if(isset($_GET['type']) && $_GET['type'] == 'artist') { echo 'selected'; } ?>>Artistas</option>
                <option value="track" <?php if(isset($_GET['type']) && $_GET['type'] == 'track') { echo 'selected'; } ?>>Pista</option>
            </select><button type="submit" class="bg-blue-500 rounded-r-full px-5 py-3 hover:bg-blue-600"><i class="fas fa-search"></i></button>
        </form>
    </div>

    <a href="https://github.com/karlosnava" target="_blank">
        <img class="w-12 h-12 rounded-full shadow-md" src="https://avatars.githubusercontent.com/u/45957545?s=400&u=f613ac2b9224973bd7414c931b88e6f25e7d4ae0&v=4">
    </a>
</div>