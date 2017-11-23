<?php
//Image upload section
if (isset($_FILES["file"]["type"])) {
    $validextensions = array("jpeg", "jpg", "png");
    $temporary = explode(".", $_FILES["file"]["name"]);
    $file_extension = end($temporary);
    if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
        ) && ($_FILES["file"]["size"] < 5000000) //Approx. 5 MB files can be uploaded.
        && in_array($file_extension, $validextensions)
    ) {
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
        } else {
            if (file_exists("upload/" . $_FILES["file"]["name"])) {
                echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
            } else {
                $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
                $targetPath = "../../food-images/" . $_FILES['file']['name']; // Target path where file is to be stored
                move_uploaded_file($sourcePath, $targetPath); // Moving Uploaded file
                echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
//                echo "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
//                echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
//                echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
//                echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>";

                require_once '../../dbconfig.php';

                $foodName = $_POST['foodName']; //here getting result from the post array after submitting the form.
                $foodPrice = $_POST['foodPrice'];
                //Fix file target in database
                $targetPath = "food-images/" . $_FILES['file']['name']; // Target path where file is to be stored
                //Category
                $category = $_POST['category'];
                //Ingredient
                $ingreArray = $_POST['ingre'];
                array_pop($ingreArray);
                $ingre = implode("|", $ingreArray);

                try {
                    $stmt = $connect->prepare("INSERT INTO foods (category_id, name, image, price, ingredients) VALUES ($category, '$foodName', '$targetPath', $foodPrice, '$ingre')");


                    if ($stmt->execute()) {
                        echo "Food has been successfully added!";
                    } else {
                        echo "Query Problem";
                    }
                } catch (PDOException $e) {
                    echo $e->getMessage();
                }
            }
        }
    } else {
        echo "<span id='invalid'>***Invalid file Size or Type***<span>";
    }
}
