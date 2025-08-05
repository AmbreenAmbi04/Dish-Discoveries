<?php
session_start();
// Database Connection
$serverName = "localhost";
$userName = "root";
$password = "";
$db_name = "db_dishdiscoveries";

// Database connection
$connection = new mysqli($serverName, $userName, $password, $db_name);

// Check for form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Error Condition Array
    $errors = [];

    // Fetching POST Data From Form
    $title = isset($_POST['recipetitle']) ? $_POST["recipetitle"] : '';
    $category = isset($_POST['recipecategory']) ? $_POST["recipecategory"] : '';
    $description = isset($_POST['recipedescription']) ? $_POST["recipedescription"] : '';
    $keyingredients = isset($_POST['keyrecipeingredients']) ? $_POST["keyrecipeingredients"] : '';
    $ingredients = isset($_POST['recipeingredients']) ? $_POST["recipeingredients"] : '';
    $instructions = isset($_POST['recipeinstructions']) ? $_POST["recipeinstructions"] : '';

    // Recipe Title Card Image
    $upload_dir = 'DishDiscoveries/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Validate and move uploaded title image
    $titleimage = $_FILES['titlerecipeimage'];
    $allowedtypes1 = ['image/jpg', 'image/png', 'image/jpeg'];
    $max_file_size1 = 15 * 1024 * 1024;

    if (!in_array($titleimage['type'], $allowedtypes1)) {
        $errors[] = 'The uploaded file should only be .jpg, .png, .jpeg format.';
    }
    if ($titleimage['size'] > $max_file_size1) {
        $errors[] = 'The uploaded file size should not exceed 15MB.';
    }

    $file_name1 = uniqid() . "-" . basename($titleimage['name']);
    $file_path1 = $upload_dir . $file_name1;

    if (!move_uploaded_file($titleimage['tmp_name'], $file_path1)) {
        $errors[] = 'Failed to upload image. Please try again.';
    }

    // Recipe Image
    $image = $_FILES['recipeimage'];
    $allowedtypes = ['image/jpg', 'image/png', 'image/jpeg'];
    $max_file_size = 15 * 1024 * 1024;

    if (!in_array($image['type'], $allowedtypes)) {
        $errors[] = 'The uploaded file should only be .jpg, .png, .jpeg format.';
    }
    if ($image['size'] > $max_file_size) {
        $errors[] = 'The uploaded file size should not exceed 15MB.';
    }

    $file_name = uniqid() . "-" . basename($image['name']);
    $file_path = $upload_dir . $file_name;

    if (!move_uploaded_file($image['tmp_name'], $file_path)) {
        $errors[] = 'Failed to upload image. Please try again.';
    }

    // If there are any validation errors, stop the process and display errors
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;' class='error ms-5 mt-3'>$error</p>";
        }
        exit;
    }
    $userid=$_SESSION["UserID"];
    // Insert data into database
    $insert = "INSERT INTO tbl_recipesharing (recipetitle, recipecategory, titlerecipeimage, recipeimage, 
    recipedescription, keyrecipeingredients, recipeingredients, recipeinstructions,userid) 
    VALUES ('$title', '$category', '$file_path1', '$file_path', '$description', '$keyingredients', '$ingredients', 
    '$instructions','$userid')";

    if ($connection->query($insert) === TRUE) {
        // Display toast
        header ("Location: index.php");
        exit();
    } else {
        echo "Error: " . $connection->error;
    }
}

$connection->close();
?>
