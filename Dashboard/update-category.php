<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upadte Category - NewsDesk</title>
    <link rel="icon" type="image/x-icon" href="../assets/imgs/NewsDesk.png">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">

</head>

<?php
    include("header.php");
    include("../Connection/connection.php");







    if (isset($_POST['btnSave'])) {
        $categoryId = $_GET['id'];
        $category = $_POST['txtCategory'];
    
        // Update the category in the database
        $query = "UPDATE Category SET Category = '$category' WHERE Id = '$categoryId'";
        
        if (mysqli_query($con, $query)) {
            echo '<script type="text/javascript">';
            echo 'alert("Category updated successfully.");';
            echo 'window.location.href = "view-categories.php";'; // Redirect to the view categories page
            echo '</script>';
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Error!! Category not updated.");';
            echo '</script>';
        }
    }

?>


<body>


    <form method="post">
        <h1 class="headings" style="width: 450px;">Update Category</h1>
        <input type="text" id="txtCategory" required name="txtCategory" />
        <input type="submit" class="button" name="btnSave" value="Save"/>
    </form>
</body>
</html>