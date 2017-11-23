<html lang="en">
<body>
<?php
require_once('navbar.php');

$food_id = $_GET['id'];
$query = "SELECT * FROM foods where food_id = $food_id";
$result = mysqli_query($connect, $query);
$row = $result->fetch_array();
?>

<div class="container">
    <form id="editFood" method="post" class="form-horizontal" role="form">
        <div class="form-group">
            <label class="col-sm-3 control-label">Food Name</label>
            <div class="col-sm-9">
                <input name="foodName" value="<?= $row['name'] ?>" placeholder="Food Name" class="form-control"
                       autofocus disabled>
                <span class="help-block">For example, Thai Chicken Basil</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Price</label>
            <div class="col-sm-9">
                <input name="foodPrice" value="<?= $row['price'] ?>" placeholder="Price" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Image File</label>
            <div class="col-sm-9">
                <div id="image_preview"><img id="previewing" height="250" src="<?= '../' . $row['image'] ?>"/></div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">In stock</label>
            <div class="col-sm-9">
                <?php if ($row['in_stock'] == 0): ?>
                    <input name="stock" type="checkbox" value="1">
                <?php else: ?>
                    <input name="stock" type="checkbox" value="0" checked>
                <?php endif; ?>
            </div>
        </div>
        <!--Ingredients section-->
        <?php
        $ing = $row['ingredients'];
        $pieces = explode("|", $ing);
        for ($i = 0; $i < count($pieces); $i++) { ?>
            <div class="form-group">
                <label class="col-sm-3 control-label">
                    <?php if ($i == 0)
                        echo "Ingredients"; ?>
                </label>
                <div class="col-sm-9">
                    <div class="input-group control-group after-add-more<?php if ($i != 0) echo "1" ?>">
                        <input type="text" name="ingre[]" value="<?= $pieces[$i] ?>" class="form-control"
                               placeholder="1/2 cup shredded carrot">
                        <div class="input-group-btn">
                            <?php if ($i == 0) { ?>
                                <button class="btn btn-success add-more" type="button"><i
                                            class="glyphicon glyphicon-plus"></i>
                                    Add
                                </button>
                            <?php } else { ?>
                                <button class="btn btn-danger remove" type="button"><i
                                            class="glyphicon glyphicon-remove"></i>
                                    Remove
                                </button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="copy-fields hide">
            <div class="control-group input-group" style="margin-top:10px">
                <input type="text" name="ingre[]" class="form-control" placeholder="1/2 cup shredded carrot">
                <div class="input-group-btn">
                    <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i>
                        Remove
                    </button>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <button class="btn btn-primary btn-block">Update Food</button>
            </div>
        </div>
        <input name="foodID" value="<?= $row['food_id'] ?>" type="hidden">
    </form> <!-- /form -->
</div> <!-- ./container -->

</body>
</html>

<script>
    $(document).ready(function () {
        ingreFields();
    });

    $("#editFood").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "php-action/editFoodSQL.php", // Url to which the request is send
            type: "POST",             // Type of request to be send, called as method
            data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
            contentType: false,       // The content type used when sending data to the server.
            cache: false,             // To unable request pages to be cached
            processData: false,        // To send DOMDocument or non processed data file it is set to false
            success: function (data)   // A function to be called if request succeeds
            {
                swal('Updated!', data, 'success').then(function () {
                    location.reload();
                });
            }
        });
    }));

    function ingreFields() {
        $(".add-more").click(function () {
            var html = $(".copy-fields").html();
            $(".after-add-more").after(html);
        });
        //here it will remove the current value of the remove button which has been pressed
        $("body").on("click", ".remove", function () {
            $(this).parents(".control-group").remove();
        });
    }
</script>