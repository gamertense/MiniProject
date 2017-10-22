<!doctype html>
<html>
<head>
    <script src="../vendor/js/Chart.bundle.min.js"></script>
    <style>
        canvas {
            -moz-user-select: none;
            -webkit-user-select: none;
            -ms-user-select: none;
        }
    </style>
</head>

<body>
<?php
require_once('navbar.php');
require_once('../dbconfig.php');
?>
<br>
<div class="container">
    <!-- <div class="col-md-2 col-md-offset-1">
        <div class="chart-container" style="position: relative; height:40vh; width:60vw">
            <canvas id="myChart"></canvas>
        </div>
    </div> -->
    <div class="table-responsive">
        <table class="table table-hover">
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
    $('#menu1').addClass('active');
    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
            datasets: [{
                label: '# of Sales',
                data: [12, 19, 3, 5, 2, 3, 8, 20, 10, 11, 15, 22],
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                fill: false
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>
