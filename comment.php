<link rel="stylesheet" type="text/css" href="vendor/css/comment.css">
<?php
require('dbconfig.php');
if (isset($_POST['submit'])) {
    $name = $_SESSION['name'];
    $comment = $_POST['comment'];
    $submit = $_POST['submit'];
    if ($name && $comment) {
        $q = "INSERT INTO comment (com_name,com_comment,food_id) VALUE ('$name','$comment','$fid')";
        $result = $connect->query($q);
    } else {
        echo "Please fill out";
    }

}
?>

<div class="container">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
    <div class="row">
        <!-- Contenedor Principal -->
        <div class="comments-container">
            <h2>Comments</h2>

            <!-- Comment Box -->
            <?php
            if (!isset($_SESSION["cu_id"])) {
                echo "login first!!<br>";
            } else {
                ?>
                <form method="POST">
                    <table>
                        <tr>
                            <td>User:</td>
                            <td><?= $_SESSION['name']; ?></td>
                        </tr>

                        <tr>
                            <td colspan="2">Comment:</td>
                        </tr>

                        <tr>
                            <td colspan="2"><textarea name="comment" placeholder="Write the review here!" rows="5"
                                                      cols="50" class="form-control"></textarea></td>
                        </tr>

                        <tr>
                            <td colspan="2">
                                <input type="submit" class="btn btn-primary" name="submit" value="Leave a comment">
                        </tr>
                    </table>

                </form>
            <?php } ?>

            <ul id="comments-list" class="comments-list">
                <?php
                $fid = $_GET['fid'];
                $q = "select com_id,com_name,com_comment from comment WHERE food_id = '$fid'";
                $result = $connect->query($q);
                while ($row = $result->fetch_array()) {
                    # code...
                    ?>
                    <li>
                        <div class="comment-main-level">
                            <!-- Avatar -->
                            <div class="comment-avatar"><img
                                        src="http://i9.photobucket.com/albums/a88/creaticode/avatar_1_zps8e1c80cd.jpg"
                                        alt=""></div>
                            <!-- Contenedor del Comentario -->
                            <div class="comment-box">
                                <div class="comment-head">
                                    <h6 class="comment-name by-author"><?= $row['com_name'] ?></h6>
                                    <?php if ($_SESSION['name'] == $row['com_name']) {
                                        echo '<a href="del-comment.php?delid=' . $row["com_id"] . '&pid=' . $fid . '">';
                                        ?>
                                        <i class="fa fa-trash-o"></i></a>
                                    <?php } ?>
                                </div>
                                <div class="comment-content"><?= $row['com_comment'] ?></div>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>