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
<?php
require_once('menu.php');
?>

<div class="container" style="width:60%;">
    <h2 align="center">Select food</h2>
    <?php
    if (!isset($_GET['input-product']))
        $query = "SELECT * FROM foods ORDER BY food_id";
    else {
        $input_product = $_GET['input-product'];
        $query = "SELECT * FROM foods WHERE name LIKE '%$input_product%'";
    }

    $result = mysqli_query($connect, $query); ?>
    <form method="post" id="foodsForm">
        <?php
        if (mysqli_num_rows($result) > 0):
            while ($row = mysqli_fetch_array($result)):
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
                        <button name="wishButton" style="margin-top:5px;" class="btn btn-info"
                                value="<?php echo $row["food_id"]; ?>"> Add to Wishlist
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
        $('#menu1').addClass('active');

        $('#cartBtn').click(function () {
            window.location.replace("cart.php");
        });

        $('#wishBtn').click(function () {
            window.location.replace("wishlist.php");
        });
    }
</script>
