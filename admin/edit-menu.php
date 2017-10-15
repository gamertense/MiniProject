<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../vendor/css/food.css">
    <link rel="stylesheet" type="text/css" href="../vendor/css/menu.css">
    <script>
        var products_JSON = [];
    </script>
</head>
<body>
<?php
require_once('navbar.php');
include_once '../dbconfig.php';

$query = "SELECT * FROM foods ORDER BY food_id";
$result = mysqli_query($connect, $query);
if (mysqli_num_rows($result) > 0):
    while ($row = mysqli_fetch_array($result)): ?>
        <script>products_JSON.push("<?php echo $row["name"]; ?>");</script>
        <?php
    endwhile;
endif;
?>

<div class="container" style="width:60%;">
    <form role="search">
        <div class="input-group">
            <input class="form-control" placeholder="Search" id="foodSearch" data-provide="autocomplete"
                   autocomplete="off">
            <div class="input-group-btn">
                <button id="searchButton" class="btn btn-default"><i
                            class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
    </form>

    <h2 align="center">Select food to edit/remove</h2><br>
    <?php
    if (!isset($_GET['s']))
        $query = "SELECT * FROM foods ORDER BY food_id";
    else {
        $food_name = $_GET['s'];
        $query = "SELECT * FROM foods WHERE name LIKE '%$food_name%'";
    }

    $result = mysqli_query($connect, $query); ?>
    <form method="post" id="foodsForm">
        <?php
        if (mysqli_num_rows($result) > 0):
            while ($row = mysqli_fetch_array($result)):
                ?>
                <div class="col-sm-4" style="display: none;">
                    <article class="col-item">
                        <div class="photo">
                            <div class="options-cart-round">
                                <button name="addButton" class="btn btn-default" title="Edit"
                                        data-toggle="tooltip" value="<?php echo $row["food_id"]; ?>">
                                    <span class="fa fa-pencil-square-o"></span>
                                </button>
                            </div>
                            <div class="options-wishlist-round">
                                <button name="wishButton" class="btn btn-default" title="Remove"
                                        data-toggle="tooltip" value="<?php echo $row["food_id"]; ?>">
                                    <span class="fa fa-trash"></span>
                                </button>
                            </div>
                            <img src="../<?php echo $row["image"]; ?>" class="img-responsive"
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

<script src="../vendor/js/jquery.autocomplete.min.js"></script>
<script>
    var foodID, btnString = 'cart';

    $(document).ready(function () {
        $(".col-sm-4").fadeIn("slow");

        var foodSearchSelector = $("#foodSearch");
        $('#foodSearch').autocomplete({lookup: products_JSON});

        // After user clicks the suggested one and hit 'enter' or 'search button'.
        var inputVal = foodSearchSelector.val();
        $("#searchButton").click(function (e) {
            e.preventDefault();
            inputVal = foodSearchSelector.val();
            window.location.href = "edit-menu.php?s=" + inputVal;
        });

        // When user types in the search box and hits the enter key.
        foodSearchSelector.keypress(function (event) {
            if (event.which == 13) {
                inputVal = foodSearchSelector.val();
                window.location.href = "edit-menu.php?s=" + inputVal;
            }
        });
        initialLoad();
    });

    function initialLoad() {
        $('#menu2').addClass('active');
        $('[data-toggle="tooltip"]').tooltip();

        $('button[name="addButton"]').click(function () {
            btnString = 'cart';
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
                if (data === "success-cart") {
                    swal(
                        'Added!',
                        'Your selected food has been added to cart',
                        'success'
                    ).then(function () {
                        location.reload();
                    });
                } else if (data === "success-wishlist") {
                    swal(
                        'Added!',
                        'Your selected food has been added to wishlist',
                        'success'
                    );
                } else if (data === "already added to wishlist") {
                    swal(
                        'Food exists!',
                        'This food is ' + data,
                        'warning'
                    );
                } else
                    alert(data)
            });
        });
    }
</script>
