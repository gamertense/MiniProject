<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thai Food Delivery</title>
    <link rel="stylesheet" type="text/css" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <style>
        /* CSS used here will be applied after bootstrap.css */
        .badge-notify {
            background: red;
            position: relative;
            top: -10px;
            left: -25px;
        }
    </style>
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
    <script src="js/bootstrap3-typeahead.min.js"></script>
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
                <button id="wishBtn" class="btn btn-default btn-lg btn-link">
                    <span class="glyphicon glyphicon-heart"></span>
                </button>
            </li>
            <li>
                <button id="cartBtn" class="btn btn-default btn-lg btn-link">
                    <span class="glyphicon glyphicon-shopping-cart"></span>
                </button>
                <span class="badge badge-notify"><?php
                    //Append search suggestion.
                    include_once 'dbconfig.php';

                    $query = "select COUNT(cart_id) from cart";
                    $result = mysqli_query($connect, $query);
                    $row = mysqli_fetch_array($result);
                    $items_count = $row['COUNT(cart_id)'];
                    echo $items_count ?>
                </span>
            </li>
        </ul>
    </div>
</nav>

<div class="container" style="width:60%;">
    <h2 align="center">My wishlist</h2>
    <?php
    $query2 = "SELECT * FROM wishlist ORDER BY wishlist_id";
    $result2 = mysqli_query($connect, $query2); ?>
    <form method="post" id="foodsForm">
        <?php
        if (mysqli_num_rows($result2) > 0):
            while ($row2 = mysqli_fetch_array($result2)):
                $food_id = $row2['food_id'];
                $query = "SELECT * FROM foods WHERE food_id = $food_id";
                $result = mysqli_query($connect, $query);
                $row = mysqli_fetch_array($result);
                ?>
                <div class="col-md-6">
                    <div style="border: 1px solid #eaeaec; margin: -1px 19px 3px -1px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); padding:10px;"
                         align="center">
                        <img src="<?php echo $row["image"]; ?>" class="img-responsive">
                        <h5 class="text-info"><?php echo $row["name"]; ?></h5>
                        <h5 class="text-danger">฿<?php echo $row["price"]; ?></h5>
                        <button name="addButton" style="margin-top:5px;" class="btn btn-success"
                                value="<?php echo $row["food_id"]; ?>"> Add to Cart
                        </button>
                    </div>

                </div>
                <?php
            endwhile;
        endif;
        ?>
    </form>
</div>
</body>
</html>

<script>
    var foodID, btnString = 'cart';

    $(document).ready(function () {
        initialLoad();


    });

    function initialLoad() {
        $('button[name="addButton"]').click(function () {
            foodID = $(this).val();
        });

        // Attach a submit handler to the form
        $("#foodsForm").submit(function (event) {
            // Stop form from submitting normally
            event.preventDefault();

            var posting = $.post("add-cart.php", {hidden_id: foodID});

            // Put the results in a div
            posting.done(function (data) {
                alert(data);
                location.reload();
            });
        });

        $('#cartBtn').click(function () {
            window.location.replace("cart.php");
        });

        $('#wishBtn').click(function () {
            window.location.replace("wishlist.php");
        });
    }
</script>