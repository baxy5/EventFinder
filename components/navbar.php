<nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/demo/">WebSzaki</a>
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
                    <a class="nav-link" href="/demo/kedvencek.php">Kedvencek</a>
                </li>

                <?php if (!$is_logged_in) { ?>
                    <a href="/demo/login.php">
                        <button type="button" class="btn btn-primary">
                            Kosár
                        </button>
                    </a>
                <?php } else { ?>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Kosár
                    </button>
                <?php } ?>
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
                <p class="lead h-100 pe-4 pt-2">
                    <strong>
                        <?php echo $_SESSION['name']; ?>
                    </strong>
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