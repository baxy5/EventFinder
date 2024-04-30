<?php
require_once ('config.php');

$basket_items = [];
$all_price = 0;

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
    $conn = get_connection();

    $sql = "SELECT * from basket WHERE user_id = '{$_SESSION['id']}'";

    $res = $conn->query($sql);

    $basket_items = $res->fetchAll(PDO::FETCH_ASSOC);

    for ($i = 0; $i < count($basket_items); $i++) {
        $all_price = $all_price + $basket_items[$i]["price"];
    }
}
?>

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Kosár</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex flex-wrap">
                <?php foreach ($basket_items as $product): ?>
                    <div class="card flex-fill" style="width: 18rem;">
                        <img src="<?php echo $product['img']; ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product['title']; ?>
                            </h5>
                            <h1>$<?php echo $product['price']; ?></h1>
                            <button data-pid="<?php echo $product['id']; ?>" data-title="<?php echo $product['title']; ?>"
                                id="delete" type="button" class="btn btn-danger">Törlés</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="modal-footer">
                <h5>Összesen: <strong>$<?php echo $all_price; ?></strong></h5>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mégse</button>
                <a href="/demo/fizetes.php">
                    <button type="button" class="btn btn-primary">Fizetés</button>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('#delete').forEach(function (button) {
            button.addEventListener('click', function (event) {
                var title = this.dataset.title;
                var id = this.dataset.pid;


                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'delete-from-basket.php', true);
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