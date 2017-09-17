<script>
    var products_JSON = [];
</script>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Thai Food Delivery</a>
        </div>
        <ul class="nav navbar-nav">
            <li id="menu1"><a href="index.php">Home</a></li>
            <!--            <li><a href="admin.html">Admin</a></li>-->
        </ul>
        <div class="col-sm-3 col-md-3">
            <form class="navbar-form" role="search">
                <div class="input-group">
                    <input class="form-control" placeholder="Search" id="foodSearch" data-provide="typeahead"
                           autocomplete="off">
                    <div class="input-group-btn">
                        <button id="searchButton" class="btn btn-default"><i
                                    class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <?php
            session_start();
            include_once 'dbconfig.php';

            $query = "SELECT * FROM foods ORDER BY food_id";
            $result = mysqli_query($connect, $query);
            if (mysqli_num_rows($result) > 0):
                while ($row = mysqli_fetch_array($result)): ?>
                    <script>products_JSON.push("<?php echo $row["name"]; ?>");</script>
                    <?php
                endwhile;
            endif;

            if (isset($_POST['email']) && isset($_POST['password'])) {
                $_SESSION["email"] = $_POST['email'];
                $_SESSION["password"] = $_POST['password'];
            }

            if (!isset($_SESSION["email"]) || !isset($_SESSION["password"])): ?>
                <form class="navbar-form navbar-right" method="post">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input type="email" class="form-control" name="email" placeholder="Email Address">
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>

                    <button class="btn btn-primary">Login</button>
                </form>
            <?php else: ?>
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
                        $query = "select COUNT(cart_id) from cart";
                        $result = mysqli_query($connect, $query);
                        $row = mysqli_fetch_array($result);
                        $items_count = $row['COUNT(cart_id)'];
                        echo $items_count ?>
                </span>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span> 
                        <strong>Mahesh</strong>
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <p class="text-center">
                                            <span class="glyphicon glyphicon-user icon-size"></span>
                                        </p>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="text-left"><strong>Mahesh</strong></p>
                                        <p class="text-left small"><?= $_SESSION['email'] ?></p>
                                        <p class="text-left">
                                        <form method="POST">
                                            <button class="btn btn-primary btn-block btn-sm">Logout
                                            </button>
                                        </form>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="navbar-login navbar-login-session">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p>
                                            <a href="#" class="btn btn-primary btn-block">My Profile</a>
                                            <a href="#" class="btn btn-danger btn-block">Change Password</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<script>
    // Insert all products into JSON file for appending in search suggestion.
    $.ajax
    ({
        type: "GET",
        dataType: 'json',
        async: true,
        url: 'create-json.php',
        data: {data: JSON.stringify(products_JSON)},
        success: function () {
            console.log("Success!");
        },
        failure: function () {
            alert("Error!");
        }
    });

    // Append search suggestion from the created JSON file above.
    var foodSearchSelector = $("#foodSearch");
    $.get("results.json", function (data) {
        foodSearchSelector.typeahead({source: data});
    }, 'json');

    // After user clicks the suggested one and hit 'enter' or 'search button'.
    var inputVal = foodSearchSelector.val();
    $("#searchButton").click(function (e) {
        e.preventDefault();
        inputVal = foodSearchSelector.val();
        window.location.href = "index.php?input-product=" + inputVal;
    });

    // When user types in the search box and hits the enter key.
    foodSearchSelector.keypress(function (event) {
        if (event.which == 13) {
            inputVal = foodSearchSelector.val();
            window.location.href = "index.php?input-product=" + inputVal;
        }
    });
</script>

<style>
    .navbar-login {
        width: 305px;
        padding: 10px;
        padding-bottom: 0px;
    }

    .navbar-login-session {
        padding: 10px;
        padding-bottom: 0px;
        padding-top: 0px;
    }

    .icon-size {
        font-size: 87px;
    }
</style>