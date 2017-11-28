<html>
<head>
    <title>Thai Food Delivery</title>
</head>
<body>
<?php
require_once('menu.php');
$fid = $_GET['fid'];
$query = "SELECT * FROM foods WHERE food_id = $fid";
$result = mysqli_query($connect, $query);
$row = $result->fetch_array();
?>
<div class="container">
    <div class="main col-md-2 col-md-offset-3">
        <img class="img-circle" src="<?= $row['image'] ?>" height="25%">
        <center><h2><font color="#DF013A"><B><?= $row['name'] ?><B></font></h2></center>
        <div class="price"><h3> PRICE : ฿<?= $row['price'] ?></h3></td></div>
        <div class="ingredient">
            <h4>Ingredients</h4>
            <ul>
                <?php
                $ing = $row['ingredients'];
                $pieces = explode("|", $ing);
                for ($i = 0; $i < count($pieces); $i++) { ?>
                    <li><?= $pieces[$i] ?></li>
                <?php } ?>

            </ul>
        </div>
        <form method="post" id="foodsForm">
            <div class="actionBtn">
                <button name="addButton" class="btn btn-success" title="Add to cart"
                        data-toggle="tooltip" value="<?php echo $row["food_id"]; ?>">
                    <span class="fa fa-shopping-cart"></span> Add to cart
                </button>
                <button name="wishButton" class="btn btn-danger" title="Add to wishlist"
                        data-toggle="tooltip" value="<?php echo $row["food_id"]; ?>">
                    <span class="fa fa-heart"></span> Add to wishlist
                </button>
            </div>
        </form>
    </div>
</div>
<?php require_once('comment.php') ?>
</body>
</html>

<script src="vendor/js/food.js"></script>

<style>
    .main {
        box-shadow: 0 0 15px #888888;
        width: 50%;
    }

    .actionBtn {
        margin: auto;
        padding-bottom: 15px;
        width: 50%;
    }

    .price {
        color: #DF013A;
        padding: 15px;
    }

    .ingredient {
        padding: 15px;
    }

    .img-circle {
        padding-top: 15px;
        display: block;
        margin: 0 auto;
        border-radius: 50%;
    }
</style>
