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
<div class="container" style="padding-top: 30px">
    <img class="img-circle" src="<?= $row['image'] ?>" height="35%">
    <center><h2><font color="#DF013A"><B><?= $row['name'] ?><B></font></h2></center>
    <br>
    <h3>
        <CENTER>ADD-ONS (choose up to 1 )</CENTER>
    </h3>

    <div class="checkbox">
        <label><input type="checkbox" value="">Rice (ข้าวสวย)</label>
    </div>
    <div class="checkbox">
        <label><input type="checkbox" value="">Boiled rice (ข้าวต้ม)</label>
    </div>
    <br><br>
    <tr>
        <h2><font color="#3B170B">
                PRICE : 45 ฿</font></h2></td>
    </tr>
</div>
</body>
</html>

<style>
    .img-circle {
        display: block;
        margin: 0 auto;
        border-radius: 50%;
    }

    .checkbox {
        font-size: 1.4em;
        color: #FE2E64;
        text-align: center;
    }

    body {
        background: url("images/plate.jpg") no-repeat center;
        background-size: cover;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-attachment: fixed;
        font-family: 'PT Sans', sans-serif;
    }
</style>
