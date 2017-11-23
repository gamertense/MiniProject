<html lang="en">
<body>

<?php
require_once('navbar.php');
?>

<div class="container">
    <form id="uploadimage" action="" method="post" class="form-horizontal" role="form">
        <div class="form-group">
            <label class="col-sm-3 control-label">Food Name</label>
            <div class="col-sm-9">
                <input name="foodName" placeholder="Food Name" class="form-control" autofocus>
                <span class="help-block">For example, Thai Chicken Basil</span>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Food Category</label>
            <div class="col-sm-9">
                <select class="form-control" name="category">
                    <?php
                    $query = "SELECT * FROM category";
                    $result = mysqli_query($connect, $query);
                    while ($row = mysqli_fetch_array($result)):
                        ?>
                        <option value="<?= $row['category_id'] ?>"><?= $row['category_name'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Price</label>
            <div class="col-sm-9">
                <input name="foodPrice" placeholder="Price" class="form-control">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Image File</label>
            <div class="col-sm-9">
                <div id="image_preview"><img id="previewing" src="../images/no-image.png"/></div>
                <input type="file" name="file" id="file" required/>
            </div>
        </div>

        <br>
        <div class="form-group">
            <label class="col-sm-3 control-label">Ingredients</label>
            <div class="col-sm-9">
                <div class="input-group control-group after-add-more">
                    <input type="text" name="ingre[]" class="form-control" placeholder="Enter Name Here">
                    <div class="input-group-btn">
                        <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i>
                            Add
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-fields hide">
            <div class="control-group input-group" style="margin-top:10px">
                <input type="text" name="ingre[]" class="form-control" placeholder="Enter Name Here">
                <div class="input-group-btn">
                    <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i>
                        Remove
                    </button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-9 col-sm-offset-3">
                <button type="submit" class="btn btn-primary btn-block">Add Food</button>
            </div>
        </div>
        <div id="message"></div>
    </form> <!-- /form -->
</div> <!-- ./container -->

</body>
</html>

<script>
    $(document).ready(function () {
        ingreFields();
        $('#menu2').addClass('active');

        $("#uploadimage").on('submit', (function (e) {
            e.preventDefault();
            $("#message").empty();
            $('#loading').show();
            $.ajax({
                url: "php-action/upload.php", // Url to which the request is send
                type: "POST",             // Type of request to be send, called as method
                data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false,       // The content type used when sending data to the server.
                cache: false,             // To unable request pages to be cached
                processData: false,        // To send DOMDocument or non processed data file it is set to false
                success: function (data)   // A function to be called if request succeeds
                {
                    $('#loading').hide();
                    $("#message").html(data);
                }
            });
        }));

        // Function to preview image after validation
        $(function () {
            $("#file").change(function () {
                $("#message").empty(); // To remove the previous error message
                var file = this.files[0];
                var imagefile = file.type;
                var match = ["image/jpeg", "image/png", "image/jpg"];
                if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                    $('#previewing').attr('src', 'noimage.png');
                    $("#message").html("<p id='error'>Please Select A valid Image File</p>" + "<h4>Note</h4>" + "<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                    return false;
                }
                else {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    });

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

    function imageIsLoaded(e) {
        $("#file").css("color", "green");
        $('#image_preview').css("display", "block");
        $('#previewing').attr('src', e.target.result);
        $('#previewing').attr('width', '250px');
        $('#previewing').attr('height', '230px');
    }
</script>