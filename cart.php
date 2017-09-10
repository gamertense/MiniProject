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
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Thai Food Delivery</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="admin.html">Admin</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li>
                <button id="cartBtn" class="btn btn-default btn-lg btn-link">
                    <span class="glyphicon glyphicon-shopping-cart"></span>
                </button>
                <span class="badge badge-notify"><?php
                    $query = "select COUNT(cart_id) from cart";
                    $result = mysqli_query($connect, $query);
                    $row = mysqli_fetch_array($result);
                    $items_count = $row['COUNT(cart_id)'];
                    echo $items_count ?></span></li>
        </ul>
    </div>
</nav>

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
            if (mysqli_num_rows($result2) > 0):
            while ($row2 = mysqli_fetch_array($result2)):
                $food_id = $row2['food_id'];
                $cart_string = $cart_string . $food_id;
                if (substr_count($cart_string, $food_id) == 1):
                    $query = "SELECT * FROM foods WHERE food_id = $food_id";
                    $result = mysqli_query($connect, $query);
                    $row = mysqli_fetch_array($result);

                    $total = 0;
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
                                <form id="cartForm" method="post">
                                    <div class="col-xs-4">
                                        <input type="number" class="form-control input-md"
                                               value="<?= getQuantity($connect, $food_id); ?>">
                                    </div>
                                    <div class="col-xs-2">
                                        <input type="hidden" name="food_id" value="<?= $row['food_id'] ?>">
                                        <button id="remove_button" type="button" class="btn btn-danger">
                                            <span class="glyphicon glyphicon-trash"> </span>
                                        </button>
                                    </div>
                                </form>
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
                        <h4 class="text-right">Total <strong>฿ <?= $total ?></strong></h4>
                    </div>
                    <div class="col-xs-3">
                        <button type="button" class="btn btn-success btn-block">
                            Checkout
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    endif;
    ?>
</div>
</body>
</html>

<script>
    $(document).ready(function () {
        $('#remove_button').on('click', function (event) {
            console.log("dfs");
            // Stop form from submitting normally
            event.preventDefault();

            // Get some values from elements on the page:
            var $form = $("#cartForm"),
                term = $form.find("input[name='food_id']").val(),
                url = $form.attr("action");

            // Send the data using post
            var posting = $.post("remove-cart.php", {food_id: term});

            // Put the results in a div
            posting.done(function (data) {
                alert(data);
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