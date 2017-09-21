<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Thai Food Delivery</title>
    <link rel="stylesheet" type="text/css" href="css/index-style.css">
</head>
<body>
<?php
require_once('menu.php');
?>

<div class="container" style="width:60%;">
    <h2 align="center">Select food</h2><br>
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
                <div class="col-sm-4">
                    <article class="col-item">
                        <div class="photo">
                            <div class="options-cart-round">
                                <button name="addButton" class="btn btn-default" title="Add to cart"
                                        data-toggle="tooltip" value="<?php echo $row["food_id"]; ?>">
                                    <span class="fa fa-shopping-cart"></span>
                                </button>
                            </div>
                            <div class="options-wishlist-round">
                                <button name="wishButton" class="btn btn-default" title="Add to wishlist"
                                        data-toggle="tooltip" value="<?php echo $row["food_id"]; ?>">
                                    <span class="fa fa-heart"></span>
                                </button>
                            </div>
                            <img src="<?php echo $row["image"]; ?>" class="img-responsive"
                                 alt="Product Image"/>
                        </div>
                        <div class="info">
                            <div class="row">
                                <div class="price-details col-md-6">
                                    <!--                                    <p class="details"> Lorem ipsum dolor sit amet, consectetur.. </p>-->
                                    <h1><?php echo $row["name"]; ?></h1>
                                    <br>
                                    <span class="price-new text-danger">฿<?php echo $row["price"]; ?></span>
                                </div>
                            </div>
                        </div>
                    </article>
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
        $('[data-toggle="tooltip"]').tooltip();
        initialLoad();
    });

    function initialLoad() {
        $('button[name="addButton"]').click(function () {
            foodID = $(this).val();
        });
        $('button[name="wishButton"]').click(function () {
            foodID = $(this).val();
            btnString = 'wish';
        });
        // Attach a submit handler to the form
        $("#foodsForm").submit(function (event) {
            // Stop form from submitting normally
            event.preventDefault();
            // Send the data using post
            var posting;
            if (btnString === 'cart')
                posting = $.post("php-action/add-cart.php", {hidden_id: foodID});
            else
                posting = $.post("php-action/add-wishlist.php", {hidden_id: foodID});
            // Put the results in a div
            posting.done(function (data) {
                alert(data);
                location.reload();
            });
        });

        $('#menu1').addClass('active');
    }
</script>
