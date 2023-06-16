<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Article - NewsDesk</title>
    <link rel="icon" type="image/x-icon" href="../assets/imgs/NewsDesk.png">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">

</head>

<?php
session_start();

    include("header.php");
    include("../Connection/connection.php");
    $query = "SELECT * FROM Category";
$result = mysqli_query($con, $query);

// Check if any categories are returned
if (mysqli_num_rows($result) > 0) {
    // Create an array to store the categories
    $categories = array();

    // Fetch each category and store it in the array
    while ($row = mysqli_fetch_assoc($result)) {
        $categories[] = $row['Category'];
    }
}
?>

<?php
// Assuming you have a database connection established

// Retrieve categories from the database
// ini_set('display_errors', 1);
// error_reporting(E_ALL);


if(isset($_POST['btnSave'])) {
    // Check if a file was uploaded
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image'];

        $targetDirectory = '/Applications/XAMPP/xamppfiles/htdocs/News-Desk/uploads/';

        $fileName = uniqid() . '_' . $image['name'];

        $targetPath = $targetDirectory . $fileName;
        if(move_uploaded_file($image['tmp_name'], $targetPath)) {
            $ArticleName = $_POST['txtName'];

            $Message = $_POST['taArea'];

            // Access the session variables
            $Email = $_SESSION['email'];
            $Name = $_SESSION['name'];
            $AuthorImage = $_SESSION['image'];
            $Category = $_POST['SelCategory'];
            $Date = date("Y-m-d");
           

            $query = "INSERT INTO Articles (ArticleName, Message, Email, Name, AuthorImage, Date, Category, Image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($con, $query);
            
            if ($stmt) {
                // Bind the parameters with the values
                mysqli_stmt_bind_param($stmt, "ssssssss", $ArticleName, $Message, $Email, $Name, $AuthorImage, $Date, $Category, $fileName);
            
                // Execute the statement
                if (mysqli_stmt_execute($stmt)) {
                    echo '<script type="text/javascript">';
                    echo 'alert("Article inserted successfully.");';
                    echo '</script>';
                } else {
                    echo '<script type="text/javascript">';
                    echo 'alert("Error!! Article not inserted.");';
                    echo '</script>';
                }
            
                // Close the statement
                mysqli_stmt_close($stmt);
            } else {
                echo '<script type="text/javascript">';
                echo 'alert("Error!! Failed to prepare the statement.");';
                echo '</script>';
            }
            
            // Close the database connection
            mysqli_close($con);
        } else {
            $error = error_get_last();

            ECHO $error['message'];


    
        }
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("No file was uploaded or an error occurred.");';
        echo '</script>';
    }
}


?>

<body>
<form method="POST" action="" enctype="multipart/form-data">
        <h1 class="headings" style="width: 300px;">Add Article</h1>
        <input type="text" name="txtName" placeholder="Article Name" required>
        <select class="input" name="SelCategory">
        <?php
    // Iterate through the categories array and create options
            foreach ($categories as $category) {
                echo '<option value="' . htmlspecialchars($category, ENT_QUOTES) . '">' . htmlspecialchars($category, ENT_QUOTES) . '</option>';
            }
        ?>
        </select>
        <textarea class="input" rows="20" style="height: 300px;" type="text" name="taArea" placeholder="Write Article Here.." required> </textarea>
        <input type="file" name="image" required>
        <input type="submit" name="btnSave" class="button" value="Save"/>
    </form>
</body>
</html>
