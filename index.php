<?php
require_once ('config.php');

// Fetch data from the API
$url = "https://fakestoreapi.in/api/products";
$data = file_get_contents($url);

// Check if data retrieval was successful
if ($data === false) {
    die('Error retrieving data from the API.');
}

// Decode JSON response
$products = json_decode($data, true);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Termékek</title>
</head>

<body>
    <?php include 'components/navbar.php'; ?>

    <h1>Termékek:</h1>
    <div class="d-flex flex-row flex-wrap justify-content-center">
        <?php foreach ($products['products'] as $product): ?>
            <div class="card" style="width: 18rem;">
                <img src="<?php echo $product['image']; ?>" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $product['title']; ?>
                    </h5>
                    <p class="card-text"><?php echo $product['description']; ?></p>
                    <h1>$<?php echo $product['price']; ?></h1>
                    <?php
                    if (!$is_logged_in) { ?>
                        <a href="/demo/login.php" class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16"
                                height="16" fill="currentColor" class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                                <path
                                    d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1" />
                            </svg></a>
                        <a href="/demo/login.php" class="btn btn-primary">Kosárba</a>
                    <?php } else { ?>
                        <button data-title="<?php echo $product['title']; ?>"
                            data-description="<?php echo $product['description']; ?>"
                            data-price="<?php echo $product['price']; ?>" data-img="<?php echo $product['image']; ?>" id="fav"
                            class="btn btn-primary"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                fill="currentColor" class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                                <path
                                    d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1" />
                            </svg></button>
                        <button id="basket" class="btn btn-primary">Kosárba</button>
                    <?php } ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('#fav').forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault();

                    var title = this.dataset.title;
                    var description = this.dataset.description;
                    var price = this.dataset.price;
                    var img = this.dataset.img;


                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', 'save-fav-item.php', true);
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
                        '&description=' + encodeURIComponent(description) +
                        '&price=' + encodeURIComponent(price) +
                        '&img=' + encodeURIComponent(img);

                    xhr.send(params);
                });
            });
        });
    </script>
</body>

</html>