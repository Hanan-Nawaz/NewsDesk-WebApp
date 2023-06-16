<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - NewsDesk</title>
    <link rel="icon" type="image/x-icon" href="../assets/imgs/NewsDesk.png">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
</head>

<body>
<?php
include("header.php");
include("../Connection/connection.php");
ini_set('display_errors', 1);
error_reporting(E_ALL);

echo '<h1 class="headings" style="width: 269px; margin-bottom: 20px;">Dashboard</h1>';

$queryCategories = "SELECT COUNT(*) AS totalCategories FROM Category";
$resultCategories = mysqli_query($con, $queryCategories);

$queryUsers = "SELECT COUNT(*) AS totalUsers FROM Users";
$resultUsers = mysqli_query($con, $queryUsers);

$queryArticles = "SELECT COUNT(*) AS totalArticles FROM Articles";
$resultArticles = mysqli_query($con, $queryArticles);

    $rowCategories = mysqli_fetch_assoc($resultCategories);
    $rowUsers = mysqli_fetch_assoc($resultUsers);
    $rowArticles = mysqli_fetch_assoc($resultArticles);

    $totalCategories = $rowCategories['totalCategories'];
    $totalUsers = $rowUsers['totalUsers'];
    $totalArticles = $rowArticles['totalArticles'];
    ?>
    <table class="table-dashboard">
        <tr>
            <td><?php echo $totalArticles; ?> <i>Articles</i></td>
            <td><?php echo $totalUsers; ?> <i>Users</i></td>
            <td><?php echo $totalCategories; ?> <i>Categories</i></td>
        </tr>
    </table>
<?php


mysqli_free_result($resultCategories);
mysqli_free_result($resultUsers);
mysqli_free_result($resultArticles);
?>



</body>
</html>
