<link rel="stylesheet" type="text/css" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">

<script src="js/jquery-3.2.1.min.js"></script>
<script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

<script src="js/bootstrap3-typeahead.min.js"></script>
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

            if (isset($_POST['name']))
                $_SESSION["name"] = $_POST['name'];

            if (!isset($_SESSION["email"]) || !isset($_SESSION["password"])): ?>
                <li><a href="signup.php">Register</a></li>
                <li class="dropdown">
                    <a href="" class="dropdown-toggle" data-toggle="dropdown">Log In <span
                                class="caret"></span></a>
                    <ul class="dropdown-menu dropdown-lr animated slideInRight" role="menu">
                        <div class="col-lg-12">
                            <div class="text-center"><h3><b>Log In</b></h3></div>
                            <form action="index.php" method="post">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input name="email" type="email" tabindex="1" class="form-control"
                                           placeholder="Email" value="" autocomplete="off" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" tabindex="2"
                                           class="form-control" placeholder="Password" autocomplete="off" required>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-7">
                                            <input type="checkbox" tabindex="3" name="remember" id="remember">
                                            <label for="remember"> Remember Me</label>
                                        </div>
                                        <div class="col-xs-5 pull-right">
                                            <input type="submit" name="login-submit" id="login-submit" tabindex="4"
                                                   class="form-control btn btn-success" value="Log In">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="text-center">
                                                <a href="http://phpoll.com/recover" tabindex="5"
                                                   class="forgot-password">Forgot Password?</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </ul>
                </li>
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
                        <strong>Jack</strong>
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
                                        <p class="text-left"><strong>Jack</strong></p>
                                        <p class="text-left small"><?= $_SESSION['email'] ?></p>
                                        <p class="text-left">
                                            <button name="logoutButton" class="btn btn-primary btn-block btn-sm">Logout
                                            </button>
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
                                            <a href="profile.php" class="btn btn-primary btn-block">My Profile</a>
                                            <a href="profile.php" class="btn btn-danger btn-block">Change Password</a>
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
    $('#cartBtn').click(function () {
        window.location.replace("cart.php");
    });

    $('#wishBtn').click(function () {
        window.location.replace("wishlist.php");
    });

    $("button[name=logoutButton]").click(function () {
        $.post("php-action/logout.php", function (data) {
            window.location.href = "index.php";
        });
    });

    // Insert all products into JSON file for appending in search suggestion.
    $.ajax
    ({
        type: "GET",
        dataType: 'json',
        async: true,
        url: 'php-action/create-json.php',
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
    $.get("php-action/results.json", function (data) {
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
    .badge-notify {
        background: red;
        position: relative;
        top: -10px;
        left: -25px;
    }

    /* CSS for dropdown login menu */
    /* General sizing */
    ul.dropdown-lr {
        width: 300px;
    }

    /* mobile fix */
    @media (max-width: 768px) {
        .dropdown-lr h3 {
            color: #eee;
        }

        .dropdown-lr label {
            color: #eee;
        }
    }

    /* CSS for dropdown account menu (after login) */
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