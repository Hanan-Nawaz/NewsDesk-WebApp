<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Categories - NewsDesk</title>
    <link rel="icon" type="image/x-icon" href="../assets/imgs/NewsDesk.png">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>

<?php
    include("header.php");
    include("../Connection/connection.php");


    if (isset($_POST['btnDelete'])) {
        $categoryId = $_POST['categoryId'];

        
    
        // Perform the delete operation
        $query = "DELETE FROM Category WHERE Id = '$categoryId'";
        if (mysqli_query($con, $query)) {
            echo '<script type="text/javascript">';
            echo 'alert("Category deleted successfully.");';
            echo '</script>';
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Error!! Category not deleted.");';
            echo '</script>';
        }
        // Display a confirmation prompt
        
    }
    

?>



<body>
    <h1 class="headings" style="width: 426px; margin-bottom: 20px;">View Categories</h1>

    <table>
        <thead>
            <th>Category Id</th>
            <th>Category Name</th>
            <th>Action</th>
        </thead>

        <?php
// Database connection details
// ...

// Retrieve data from the table
$query = "SELECT * FROM Category";
$result = mysqli_query($con, $query);

// Check if any rows are returned
if (mysqli_num_rows($result) > 0) {

    // Fetch and display each row of data
    while ($row = mysqli_fetch_assoc($result)) {
        $categoryId = $row['Id'];
        $categoryName = $row['Category'];

?>

<tbody>
            <td><?php echo $categoryId ?></td>
            <td><?php echo $categoryName ?></td>
            <td><a href="update-category.php?id=<?php echo $categoryId; ?>" class="button">Edit</a></td>
            <td>
            <form method="post" onsubmit="return confirmDelete();">
                    <input type="hidden" name="categoryId" value=<?php echo $categoryId; ?>>
                    <button class="btn" type="submit" name="btnDelete">Delete</button>
            </form> </td>
        </tbody>
              <?php
    }

} else {
    echo '<p>No data found.</p>';
}

// Close the database connection
mysqli_close($con);
?>

       
    </table>
</body>
</html>