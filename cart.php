<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thai Food Delivery</title>
</head>
<body>
<?php
require_once('menu.php');
?>

<div class="container" style="width:60%;">
    <div class="col-xs-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">
                    <div class="row">
                        <div class="col-xs-6">
                            <h5><span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart</h5>
                        </div>
                        <div class="col-xs-6">
                            <a href="index.php">
                                <button type="button" class="btn btn-primary btn-sm btn-block">
                                    <span class="glyphicon glyphicon-share-alt"></span> Continue shopping
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $query = "SELECT foods.food_id, name, price, image, quantity FROM foods INNER JOIN cart on foods.food_id = cart.food_id
";
            $result = mysqli_query($connect, $query);
            $total = 0;
            if (mysqli_num_rows($result) > 0):
            while ($row = mysqli_fetch_array($result)):
            $food_id = $row['food_id'];
            ?>
            <form id="cartForm" method="post">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-2"><img class="img-responsive" src="<?= $row["image"]; ?>">
                        </div>
                        <div class="col-xs-4">
                            <h4 class="product-name"><strong><?= $row["name"]; ?></strong></h4>
                            <h4>
                                <small>Food description</small>
                            </h4>
                        </div>
                        <div class="col-xs-6">
                            <div class="col-xs-6 text-right">
                                <h5><strong><?= $row["price"]; ?> <span class="text-muted">x</span></strong>
                                </h5>
                            </div>

                            <div class="col-xs-4">
                                <input id="inputQuantity" name="qty" class="form-control input-md"
                                       value="<?= $row["quantity"]; ?>" min="1" type="number">
                            </div>
                            <div class="col-xs-2">
                                <button name="removeButton" value="<?= $row['food_id'] ?>"
                                        class="btn btn-danger">
                                    <span class="glyphicon glyphicon-trash"> </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr>
                </div>
                <?php
                $total += $row['price'] * $row["quantity"];
                endwhile;
                ?>
                <div class="panel-footer">
                    <div class="row text-center">
                        <div class="col-xs-9">
                            <h4 id="totalPrice" class="text-right">Total <strong>฿ <?= $total ?></strong></h4>
                        </div>
                        <div class="col-xs-3">
                            <button name="checkoutButton" class="btn btn-success btn-block">Checkout</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <?php
    endif;
    ?>
</div>
</body>
</html>

<script>
    var foodID, action = "remove", qty;

    $(document).ready(function () {
        // When user changes input quantity.
        $("#inputQuantity").change(function () {
            action = "updateQty";
            qty = this.value;
        });

        $('button[name="removeButton"]').click(function () {
            foodID = $(this).val();
        });

        $('button[name="checkoutButton"]').click(function () {
            action = "checkout";
        });

        $("#cartForm").submit(function (event) {
            // Stop form from submitting normally
            event.preventDefault();

            // Send the data using post
            var posting = $.post("php-action/cart-action.php", {food_id: foodID, action: action});

            // Put the results in a div
            posting.done(function () {
                if (action === "checkout")
                    window.location.replace("payment.php");
                else
                    window.location.reload();
            });
        });
    });
</script>

<style>
    /* CSS used here will be applied after bootstrap.css */
    .badge-notify {
        background: red;
        position: relative;
        top: -10px;
        left: -25px;
    }
</style>