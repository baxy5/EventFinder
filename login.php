<?php
require_once ('config.php');


if (isset($_POST['name']) && isset($_POST['password'])) {
    $conn = get_connection();

    $sql = "SELECT * FROM users WHERE name = '{$_POST['name']}' AND password = SHA1('{$_POST['password']}')";

    $res = $conn->query($sql);
    $records = $res->fetchAll(PDO::FETCH_ASSOC);

    if (count($records) === 1) {
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['name'] = $records[0]['name'];
        $_SESSION['id'] = $records[0]['id'];
        header('Location: index.php');
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Log in</title>
</head>

<body>
    <?php include 'components/navbar.php'; ?>

    <div class="container pt-5" style="height: 80vh;">
        <h1>Bejelentkezés</h1>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Felhasználó név</label>
                <input type="name" name="name" class="form-control" id="name" aria-describedby="nameHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Jelszó</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Bejelentkezés</button>
        </form>
    </div>

    <?php include 'components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>