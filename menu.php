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
                        <button id="searchButton" class="btn btn-default" ><i
                                    class="glyphicon glyphicon-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
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
                    $query = "SELECT * FROM foods ORDER BY food_id";
                    $result = mysqli_query($connect, $query);
                    if (mysqli_num_rows($result) > 0):
                        while ($row = mysqli_fetch_array($result)): ?>
                            <script>products_JSON.push("<?php echo $row["name"]; ?>");</script>
                            <?php
                        endwhile;
                    endif;

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