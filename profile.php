<!doctype html>
<html>
<head>
    <title>User profile</title>
    <link rel="stylesheet" type="text/css" href="bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <?php require_once('menu.php');
    if (isset($_POST['save'])) {
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['address'] = $_POST['address'];
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['name'] = $_POST['name'];
    } ?>
</head>
<body>
<div class="container">
    <h1 class="page-header">Edit Profile</h1>
    <div class="row">
        <!-- left column -->
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="text-center">
                <img src="images/programmer.png" class="avatar img-circle img-thumbnail" alt="avatar">
                <!--<h6>Upload a different photo...</h6>
                <input type="file" class="text-center center-block well well-sm">-->
            </div>
        </div>
        <!-- edit form column -->
        <div class="col-md-8 col-sm-6 col-xs-12 personal-info">
            <!--<div class="alert alert-info alert-dismissable">
                <a class="panel-close close" data-dismiss="alert">×</a>
                <i class="fa fa-coffee"></i>
                This is an <strong>.alert</strong>. Use this to show important messages to the user.
            </div>-->
            <h3>Personal info</h3>
            <form method="post" class="form-horizontal">
                <div class="form-group">
                    <label class="col-lg-3 control-label">Name:</label>
                    <div class="col-lg-8">
                        <input name="name" class="form-control" value="<?php
                        if (isset($_SESSION['name']))
                            echo $_SESSION['name'];
                        else
                            echo "Jack";
                        ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Email:</label>
                    <div class="col-lg-8">
                        <input name="email" class="form-control" value="<?= $_SESSION['email'] ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Address:</label>
                    <div class="col-lg-8"><textarea name="address" class="form-control" rows="4"><?php
                            if (isset($_SESSION['address']))
                                echo $_SESSION['address'];
                            else
                                echo "Calista Wise
7292 Dictum Av.
San Antonio MI 47096
(492) 709-6392";
                            ?></textarea></div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Username:</label>
                    <div class="col-md-8">
                        <input name="username" class="form-control" value="<?php
                        if (isset($_SESSION['username']))
                            echo $_SESSION['username'];
                        else
                            echo $_SESSION['email'];
                        ?>" type="text">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Password:</label>
                    <div class="col-md-8">
                        <input class="form-control" value="11111122333" type="password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Confirm password:</label>
                    <div class="col-md-8">
                        <input class="form-control" value="11111122333" type="password">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                        <input name="save" class="btn btn-primary" value="Save Changes" type="submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>