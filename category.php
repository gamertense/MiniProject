<?php
include_once 'dbconfig.php';
?>
<form class="navbar-form">
    <div class="dropdown">
        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown">
            Categories
            <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
            <?php
            $query = "SELECT * FROM category";
            $result = mysqli_query($connect, $query);
            while ($row = mysqli_fetch_array($result)):
                ?>
                <li><a href="food.php?catID=<?= $row['category_id'] ?>"><?php echo $row['category_name'] ?></a></li>
            <?php endwhile; ?>
        </ul>
    </div>
</form>