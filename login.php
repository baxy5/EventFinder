<?php
require_once ('config.php');


if (isset($_POST['email']) && isset($_POST['password'])) {
    $conn = get_connection();

    $sql = "SELECT * FROM auth WHERE email = '{$_POST['email']}' AND password = SHA1('{$_POST['password']}')";

    $res = $conn->query($sql);
    $records = $res->fetchAll(PDO::FETCH_ASSOC);

    if (count($records) === 1) {
        $_SESSION['isLoggedIn'] = true;
        $_SESSION['email'] = $records[0]['email'];
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

    <div class="container pt-5">
        <h1>Login</h1>
        <form action="" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email cím</label>
                <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Jelszó</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Bejelentkezés</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>