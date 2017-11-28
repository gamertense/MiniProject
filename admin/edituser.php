<!doctype html>
<html>
<head>
    <title>Edit user status</title>
</head>

<body>
<?php
require_once('navbar.php');
require_once('../dbconfig.php');

if (isset($_POST['disable'])) {
    $id = $_POST['disable'];

    $q = "SELECT disable from customer WHERE cu_id = $id";
    $results = mysqli_query($connect, $q);
    $rows = mysqli_fetch_array($results);
    if ($rows['disable'] == 1) {
        $sql = "UPDATE customer SET disable = 0 WHERE cu_id = $id";
    } else {
        $sql = "UPDATE customer SET disable = 1 WHERE cu_id = $id";
    }


    if ($connect->query($sql) === FALSE)
        echo "Error updating record: " . $connect->error;
}
?>
<link rel="stylesheet" type="text/css" href="../vendor/css/dataTables.bootstrap.min.css">
<script src="../vendor/js/jquery.dataTables.min.js"></script>
<script src="../vendor/js/dataTables.bootstrap.min.js"></script>
<br>
<form method="post" id="deliveryForm">
    <div class="container">
        <div class="table-responsive">
            <table class="table table-hover" id="deliveryTable">
                <thead>
                <tr>

                    <th> Name</th>
                    <th> Email</th>
                    <th> Type</th>
                    <th> Status</th>
                </tr>
                </thead>
                <tbody>

                <?php
                $query = "SELECT * FROM customer";
                $result = mysqli_query($connect, $query);
                if (mysqli_num_rows($result) > 0):
                    ?>
                    <input type="hidden" value="<?= $row['cu_id'] ?>">
                    <?php
                    while ($row = mysqli_fetch_array($result)): ?>
                        <tr>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['usertype'] ?></td>
                            <td>
                                <button name="disable" value="<?= $row['cu_id'] ?>" class="
                            <?php if ($row['disable'] == 1) echo "btn btn-danger";
                                else echo "btn btn-success"; ?>" >
                                <?php if ($row['disable'] == 1) echo "Disabled";
                                else echo "Active"; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>
</form>
</body>
</html>

<script>
    $('#menu5').addClass('active');
    $('#deliveryTable').DataTable();
</script>
