<!doctype html>
<html>
<head>
    
</head>

<body>
<?php
require_once('navbar.php');
require_once('../dbconfig.php');
?>
<link rel="stylesheet" type="text/css" href="../vendor/css/dataTables.bootstrap.min.css">
    <script src="../vendor/js/Chart.bundle.min.js"></script>
    <script src="../vendor/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/js/dataTables.bootstrap.min.js"></script>
<br>
<div class="container">
    <div class="table-responsive">
        <table class="table table-hover" id="deliveryTable">
            <thead>
            <tr>
            	<th>Order date</th>
                <th>Customer name</th>
                <th>Food name</th>
                <th>Quantity</th>
                <th>Address</th>
                <th>Delivery status</th>
            </tr>
            </thead>
            <tbody>

            <?php
            $query = "SELECT orderDate, c.name as cu_name, f.name as f_name, quantity, address, isDelivered
                          FROM orders o join customer c on c.cu_id = o.cu_id
                          join foods f on f.food_id = o.food_id having isDelivered = 0";
            $result = mysqli_query($connect, $query);
            if (mysqli_num_rows($result) > 0):
                ?>
                <form method="post">
                <input type="hidden" value="<?= $row['order_id'] ?>">
                <?php
                while ($row = mysqli_fetch_array($result)):
                    ?>                    
                    <tr>
                    	<td><?= $row['orderDate'] ?></td>
                        <td><?= $row['cu_name'] ?></td>
                        <td><?= $row['f_name'] ?></td>
                        <td><?= $row['quantity'] ?></td>
                        <td><?= $row['address'] ?></td>
                        <td><input type="checkbox" value="1" <?php if ($row['isDelivered'] == 1)
                                echo "checked"; ?>></td>
                    </tr>
                <?php endwhile; ?>
            </form>
            <?php endif; ?>
            </tbody>
        </table>
        <button class="btn btn-success" style="float: right">Update</button>
    </div>
</div>
</body>
</html>

<script>
$(document).ready(function() {
    $('#menu1').addClass('active');
    $('#deliveryTable').DataTable();
});
</script>
