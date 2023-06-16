<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users - NewsDesk</title>
    <link rel="icon" type="image/x-icon" href="../assets/imgs/NewsDesk.png">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>

<?php
session_start();

include("header.php");
include("../Connection/connection.php");

if (isset($_POST['btnACtive'])) {
    $userId = $_POST['categoryId1'];
    $status = 'Active';

    
    $query = "UPDATE Users SET Status = ? WHERE Email = ?";
    $stmt = mysqli_prepare($con, $query);
    
    if ($stmt) {
        // Bind the parameters with the values
        mysqli_stmt_bind_param($stmt, "ss", $status, $userId);
    
        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo '<script type="text/javascript">';
            echo 'alert("Status updated successfully.");';
            header("Location: ".$_SERVER['PHP_SELF']);
            echo '</script>';
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Error!! Status not updated.");';
            header("Location: ".$_SERVER['PHP_SELF']);
            echo '</script>';
        }
        
        // Close the statement
        mysqli_stmt_close($stmt);
    }
    // Display a confirmation prompt
    
}

if (isset($_POST['btnDelete'])) {
    $userId = $_POST['categoryId2'];
    $status = 'InActive';

    
    $query = "UPDATE Users SET Status = ? WHERE Email = ?";
    $stmt = mysqli_prepare($con, $query);
    
    if ($stmt) {
        // Bind the parameters with the values
        mysqli_stmt_bind_param($stmt, "ss", $status, $userId);
    
        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo '<script type="text/javascript">';
            echo 'alert("Status updated successfully.");';
            echo '</script>';
            header("Location: ".$_SERVER['PHP_SELF']);
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Error!! Status not updated.");';
            echo '</script>';
            header("Location: ".$_SERVER['PHP_SELF']);
        }
        
        // Close the statement
        mysqli_stmt_close($stmt);
    }
    // Display a confirmation prompt
    
}

?>

<body>
    <h1 class="headings" style="width: 290px; margin-bottom: 20px;">View Users</h1>
    <table>
        <thead>
            <th>Email</th>
            <th>Name</th>
            <th>Password</th>
            <th>Image</th>
            <th>Status</th>
            <th style="width:200px;">Action</th>
        </thead>
    <?php
// Database connection details
// ...
$Email = $_SESSION['email'];

// Retrieve data from the table
$query = "SELECT * FROM Users";
$result = mysqli_query($con, $query);

// Check if any rows are returned
if (mysqli_num_rows($result) > 0) {

    // Fetch and display each row of data
    while ($row = mysqli_fetch_assoc($result)) {
        $categoryId = $row['Email'];

?>
        



        <tbody>
        <td><?php echo $row["Email"] ?></td>
        <td><?php echo $row["Name"] ?></td>
        <td><?php echo $row["Password"] ?></td>
            <td><img src="../uploads/<?php echo $row["Image"]; ?>" alt="Article Image" /></td>
            <td><?php echo $row["Status"] ?></td>
            <td>
            <form method="post" onsubmit="return confirmDelete();">
                    <input type="hidden" name="categoryId1" value=<?php echo $categoryId; ?>>
                    <button class="button" type="submit" name="btnACtive">Active</button>
            </form> </td>
            <td>
            <form method="post" onsubmit="return confirmDelete();">
                    <input type="hidden" name="categoryId2" value=<?php echo $categoryId; ?>>
                    <button class="btn" type="submit" name="btnDelete">InActive</button>
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