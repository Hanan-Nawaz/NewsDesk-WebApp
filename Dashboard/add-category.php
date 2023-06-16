<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category - NewsDesk</title>
    <link rel="icon" type="image/x-icon" href="../assets/imgs/NewsDesk.png">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">

</head>

<?php
    include("header.php");
    include("../Connection/connection.php");

    

    if(isset($_POST['btnSave'])) {
        // Check if a file was uploaded
       


        
    
                $Category = $_POST['txtCategory'];
    
                // Database connection details
               
    
                $query = "INSERT INTO Category (Category) VALUES ('$Category')";
                if (mysqli_query($con, $query)) {
                    echo '<script type="text/javascript">';
                    echo 'alert("Category Saved Successfully.");';
                    echo '</script>';
                } else {
                    echo '<script type="text/javascript">';
                    echo 'alert("Error!! Category not saved.");';
                    echo '</script>';
                }
    
                // Close the database connection
                mysqli_close($con);
            } 
        


?>


<body>


    <form method="post">
        <h1 class="headings" style="width: 360px;">Add Category</h1>
        <input type="text" name="txtCategory" id="txtCategory" placeholder="Category Name" required>
        <input type="submit" class="button" name="btnSave" value="Save"/>
    </form>
</body>
</html>