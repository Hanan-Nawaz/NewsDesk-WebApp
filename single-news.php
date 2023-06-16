<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="assets/imgs/NewsDesk.png">
    <title>Single News - NewsDesk</title>
    <link rel="stylesheet" type="text/css" href="assets/css/our-team.css">
</head>

<?php 
		ini_set('display_errors', 1);
        error_reporting(E_ALL);
               include("Connection/connection.php");
        $id = $_GET['id'];
        $selectQuery = "SELECT * FROM Articles WHERE ID = ?";
$selectStmt = mysqli_prepare($con, $selectQuery);

if ($selectStmt) {
    // Bind the ID parameter
    mysqli_stmt_bind_param($selectStmt, "i", $id);

    // Execute the statement
    if (mysqli_stmt_execute($selectStmt)) {
        // Retrieve the result
        $result = mysqli_stmt_get_result($selectStmt);

        // Check if the result has a row
        if (mysqli_num_rows($result) > 0) {
            // Fetch the row
            $row = mysqli_fetch_assoc($result);
            $ArticleName = $row['ArticleName'];
            $Message = $row['Message'];
            $Email = $row['Email'];
            $Name = $row['Name'];
            $AuthorImage = $row['AuthorImage'];
            $Date = $row['Date'];
            $Category = $row['Category'];
            $Image = $row['Image'];


            

            // Now you can use these variables as needed
            // ...
        }
    }

    mysqli_stmt_close($selectStmt);
}
?>

<body>
    <header>
        <div class="container">
            <div class="col-div-6">
                <p class="logo"><span>News</span>Desk</p>
            </div>
            <div class="col-div-6">
                <ul class="nav">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="index.php#latest">Latest</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="about-us.php">About Us</a></li>
                    <li><a href="our-team.php">Our Team</a></li>
                    <li><a class="buttons" href="auth.php">Join US</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </header>



<section id="single-news">
    <img src="uploads/<?php echo $Image; ?>" />
    <p class="category"><?php echo $Category; ?></p>
    <h1><?php echo $ArticleName; ?></h1>
    <p><?php echo $Message; ?></p>

	<div class="team-section " >
		<div class="inner-width">
			<div class="pers">
    <div class="pe" style="width: 350px; heiht: 200px;">
    <p>Author Details</p>
					<img src="uploads/<?php echo $AuthorImage; ?>" style="width:190px; height: 160px" alt="rafeh">
					<div class="p-name"><?php echo $Name; ?></div>
					<div class="p-des" style="font-size:15px;"><?php echo $Email; ?></div>
					Published on: <?php echo $Date; ?>
					</div>
                    </div>
                    </div>
                    </div>
                    </div>
                
                    <p class="category" style="">Top Headlines</p>

</section>

<section id="latest">
	<div class="container" style="text-align:center;">

		<br>
		
<?php

$selectQuery = "SELECT * FROM Articles ORDER BY Date DESC LIMIT 1, 3";
$selectStmt = mysqli_prepare($con, $selectQuery);

if ($selectStmt) {
    // Execute the statement
    if (mysqli_stmt_execute($selectStmt)) {
        // Retrieve the result
        $result = mysqli_stmt_get_result($selectStmt);

        // Check if the result has rows
        if (mysqli_num_rows($result) > 0) {
            // Loop through the rows
			$counter = 0;

            while ($row = mysqli_fetch_assoc($result)) {
                // Retrieve the variables
                $Id = $row['Id'];
                $ArticleName = $row['ArticleName'];
                $Message = $row['Message'];
                $Email = $row['Email'];
                $Name = $row['Name'];
                $AuthorImage = $row['AuthorImage'];
                $Date = $row['Date'];
                $Category = $row['Category'];
                $Image = $row['Image'];

                // Now you can use these variables as needed
                // ...
				$words = explode(' ', $Message);

				// Get the first 20 words
				$first20Words = implode(' ', array_slice($words, 0, 20));
		?>
<a href="single-news.php?id=<?php echo $Id; ?>">
		<div class="box-2">
			
		<img src="uploads/<?php echo $Image; ?>" class="b-img-1">
			<h3 class="heading1"><?php echo $Category; ?></h3>
			<p class="blog-heading-1"><?php echo $ArticleName; ?></p>
				<p class="text"><?php echo $first20Words; ?>....</p>
				<span class="name"><?php echo $Name; ?> . <?php echo $Date; ?></span>
				
		</div>
		</a>
		<?php 
		                $counter++;

		if ($counter % 3 === 0) {
                    // Output the clearfix div after every three records
                    echo '<div class="clearfix"></div>';
                }
	}
}
}
mysqli_stmt_close($selectStmt);
}

?>
		

		
		<div class="clearfix"></div>
	</div>
</section>

    <footer>
        <div class="container">
          <p>Copyright@ News Desk | Developed by <a style="color: rgb(115, 146, 173);" href="https://hanannawaz.com">Abdul Hanan Nawaz</a> & Team</p>
        </div>
      </footer>
</body>
</html>