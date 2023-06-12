<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">FFF</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="./index.php">Équipe</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./admin.php">Espace sélectionneur</a>
            </li>
            <?php
            if (isset($_SESSION) && count($_SESSION) > 0) {
                echo '<li class="nav-item"><a class="nav-link" href="./logout.php">Déconnexion</a></li>';
            }
            ?>

        </ul>
    </div>
</nav>
