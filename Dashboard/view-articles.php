<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Articles - NewsDesk</title>
    <link rel="icon" type="image/x-icon" href="../assets/imgs/NewsDesk.png">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>

<?php
session_start();

include("header.php");
include("../Connection/connection.php");

if (isset($_POST['btnDelete'])) {
    $categoryId = $_POST['categoryId'];

    

    // Perform the delete operation
    $query = "DELETE FROM Articles WHERE Id = '$categoryId'";
    if (mysqli_query($con, $query)) {
        echo '<script type="text/javascript">';
        echo 'alert("Article deleted successfully.");';
        echo '</script>';
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Error!! Article not deleted.");';
        echo '</script>';
    }
    // Display a confirmation prompt
    
}

?>

<body>
    <h1 class="headings" style="width: 345px; margin-bottom: 20px;">View Articles</h1>

    <table>
        <thead>
            <th>Article Title</th>
            <th>Article Author</th>
            <th>Article Image</th>
            <th style="width:240px;">Action</th>
        </thead>


        <?php
// Database connection details
// ...
$Email = $_SESSION['email'];

// Retrieve data from the table
$query = "SELECT * FROM Articles where Email='$Email'";
$result = mysqli_query($con, $query);

// Check if any rows are returned
if (mysqli_num_rows($result) > 0) {

    // Fetch and display each row of data
    while ($row = mysqli_fetch_assoc($result)) {
        $categoryId = $row['Id'];

?>
        
        <tbody>
        <td><?php echo $row["ArticleName"] ?></td>
        <td><?php echo $row["Name"] ?></td>
        <td><img src="../uploads/<?php echo $row["Image"]; ?>" alt="Article Image" /></td>
        <td><a href="update-article.php?id=<?php echo $categoryId; ?>" class="button">Edit</a></td>
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