<?php
require_once ('config.php');

$products = [];


if (!$is_logged_in || $is_logged_in !== true) {
    header('Location: login.php');
    exit;
} else {
    $conn = get_connection();

    $sql = "SELECT * from items WHERE user_id = '{$_SESSION['id']}'";

    $res = $conn->query($sql);

    $products = $res->fetchAll(PDO::FETCH_ASSOC);
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Kedvenc termékek</title>
</head>

<body>
    <?php include 'components/modal.php'; ?>
    <?php include 'components/navbar.php'; ?>

    <h1>Kedvelt termékek:</h1>
    <div class="d-flex flex-row flex-wrap" style="height: 80vh;">
        <?php foreach ($products as $product): ?>
            <div class="card" style="width: 18rem;">
                <img src="<?php echo $product['img']; ?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $product['title']; ?>
                    </h5>
                    <p class="card-text"><?php echo $product['description']; ?></p>
                    <h1>$<?php echo $product['price']; ?></h1>
                    <button id="basket" class="btn btn-primary">Kosárba</button>
                    <button data-pid="<?php echo $product['id']; ?>" data-title="<?php echo $product['title']; ?>"
                        id="delete" type="button" class="btn btn-danger">Törlés</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php include 'components/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('#delete').forEach(function (button) {
                button.addEventListener('click', function (event) {
                    var title = this.dataset.title;
                    var id = this.dataset.pid;


                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'delete-fav-item.php', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                console.log(xhr.responseText);
                            } else {
                                console.error('Error:', xhr.status);
                            }
                        }
                    };
                    var params =
                        '&title=' + encodeURIComponent(title) +
                        '&id=' + encodeURIComponent(id);

                    xhr.send(params);
                    location.reload();
                });
            });
        });
    </script>
</body>

</html>