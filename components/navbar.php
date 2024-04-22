<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">WebShop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/demo/">Termékek</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/demo/kedvencek">Kedvencek</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/demo/kosar">Kosár</a>
                </li>
            </ul>
            <?php if (!$is_logged_in) { ?>
                <div>
                    <a href="/demo/login.php">
                        <button type="button" class="btn btn-primary">Bejelentkezés</button>
                    </a>
                    <a href="/demo/regist.php">
                        <button type="button" class="btn btn-primary">Regisztráció</button>
                    </a>
                </div>
            <?php } else { ?>
                <!-- TODO: Name kéne majd -->
                <p>
                    <?php echo $_SESSION['email']; ?>
                </p>
                <div>
                    <a href="/demo/logout.php">
                        <button type="button" class="btn btn-warning">Kijelentkezés</button>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</nav>