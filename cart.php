<?php
include_once 'dbconfig.php';
function getQuantity($connect, $food_id)
{
    $query = "select COUNT(food_id) from cart WHERE food_id = $food_id";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);
    return $row['COUNT(food_id)'];
}

?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thai Food Delivery</title>
    <link rel="stylesheet" type="text/css" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
</head>
<body>
<?php
require_once('menu.php');
?>

<form id="cartForm" method="post">
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
                $query2 = "SELECT * FROM cart ORDER BY cart_id";
                $result2 = mysqli_query($connect, $query2);
                $cart_string = "";
                $total = 0;
                if (mysqli_num_rows($result2) > 0):
                while ($row2 = mysqli_fetch_array($result2)):
                    $food_id = $row2['food_id'];
                    $cart_string = $cart_string . $food_id;
                    if (substr_count($cart_string, $food_id) == 1): //Condition to handle showing duplicated food.
                        $query = "SELECT * FROM foods WHERE food_id = $food_id";
                        $result = mysqli_query($connect, $query);
                        $row = mysqli_fetch_array($result);
                        ?>
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
                                        <input id="inputQuantity" type="number" class="form-control input-md"
                                               value="<?= getQuantity($connect, $food_id); ?>" min="1">
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
                        $total += $row['price'] * getQuantity($connect, $food_id);
                    endif;
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
            </div>
        </div>
        <?php
        endif;
        ?>
    </div>
</form>
</body>
</html>

<script>
    var foodID, action = "remove";

    $(document).ready(function () {
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
            var posting = $.post("remove-cart.php", {food_id: foodID, action: action});

            // Put the results in a div
            posting.done(function (data) {
                alert(data);
                window.location.reload();
            });
        });

        $("#inputQuantity").change(function () {
            var direction = this.defaultValue < this.value;
            this.defaultValue = this.value;
            if (direction) {
//                alert("increase!");
            }
            else {
//                alert("decrease!");
            }
            $('#totalPrice').html("<a href='cart.php'>Click here to update total price</a>");
        });

        $('#cartBtn').click(function () {
            window.location.replace("cart.php");
        });

        $('#wishBtn').click(function () {
            window.location.replace("wishlist.php");
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