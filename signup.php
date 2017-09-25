<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
    <title>Online Food World Responsive Widget Template :: w3layouts</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="keywords" content="Online Food World  template Responsive, Login form web template,Flat Pricing tables,Flat Drop downs Sign up Web Templates,
 Flat Web Templates, Login sign up Responsive web template, SmartPhone Compatible web template, free web designs for Nokia, Samsung, LG, SonyEricsson, Motorola web design">
    <script type="application/x-javascript"> addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        } </script>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <!-- Custom Theme files -->
    <link href="css/signup.css" rel='stylesheet' type='text/css'/>
    <!--fonts-->
    <link href="//fonts.googleapis.com/css?family=Cookie" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i" rel="stylesheet">
    <!--//fonts-->
</head>
<body>
<!-- login -->
<h1 class="wthree">Thai Food Delivery</h1>
<div class="container login-section">
    <div class="login-w3l">
        <div class="login-form">
            <h2 class="wthree">Sign up!</h2>
            <form action="index.php" method="post" class="agile_form">
                <div class="w3ls-name1">
                    <label class="header">name</label>
                    <input placeholder="Enter your name" name="name" type="text" required="">
                </div>
                <div class="w3ls-name1">
                    <label class="header">email</label>
                    <input placeholder="email@example.com" name="email" type="email" required="">
                </div>
                <div class="w3ls-name1">
                    <label class="header">password</label>
                    <input placeholder="*****" name="password" type="password" required="">
                </div>
                <input id="submitBtn" type="submit" value="Signup">
            </form>
        </div>
    </div>
    <div class="login-w3l-bg">
        <img src="images/papaya.jpg" alt=""/>
    </div>
    <div class="clearfix"></div>
</div>
<p class="footer">© 2017 Online Food World. All Rights Reserved | Designed by <a href="http://w3layouts.com/">
        W3layouts</a></p>
</body>
</html>

<script>
    $(document).ready(function () {
        $("input[name='name']").keypress(function (e) {
            var key = e.keyCode;
            if (key >= 48 && key <= 57) {
                e.preventDefault();
            }
        });
    });
</script>