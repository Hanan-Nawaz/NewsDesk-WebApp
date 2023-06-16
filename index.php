<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Home - NewsDesk</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="icon" type="image/x-icon" href="assets/imgs/NewsDesk.png">
</head>
<body>

	

<header>
	<div class="container">
		<div class="col-div-6">
			<p class="logo"><span><i>News</i></span>Desk</p>
		</div>
		<div class="col-div-6">
			<ul class="nav">
				<li><a href="#">Home</a></li>
				<li><a href="#latest">Latest</a></li>
				<li><a href="contact.php">Contact</a></li>
				<li><a href="about-us.php">About Us</a></li>
				<li><a href="our-team.php">Our Team</a></li>
				<li><a class="buttons" href="auth.php">Join US</a></li>
			</ul>
		</div>
		<div class="clearfix"></div>
	</div>
</header>

<section class="banner-section">
	<div class="container">
		<div class="col-div-6">
			<h1 style="text-align: center;" class="heading"><span><i>News</i>Desk</span><br> Explore Trending News</h1>
		</div>
		<div class="col-div-6">
			<br><br><br><br>
			<div style="text-align: center;"><img src="assets/imgs/NewsDesk.png" class="ban-img"></div>
		</div>
		<div class="clearfix"></div>
	</div>
</section>


<section>
	<div class="container">
		<br><br>

		<?php 
		ini_set('display_errors', 1);
 error_reporting(E_ALL);
		include("Connection/connection.php");

		$selectQuery = "SELECT * FROM Articles ORDER BY Id DESC LIMIT 1";
        $selectStmt = mysqli_prepare($con, $selectQuery);

        if ($selectStmt) {

            // Execute the statement
            if (mysqli_stmt_execute($selectStmt)) {
                // Retrieve the result
                $result = mysqli_stmt_get_result($selectStmt);

                // Check if the result has rows
                if (mysqli_num_rows($result) > 0) {
                    // Fetch the row as an associative array
                    $row = mysqli_fetch_assoc($result);
					$Id = $row['Id'];

                    // Retrieve the variables
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
			$words = explode(' ', $Message);

			// Get the first 20 words
			$first20Words = implode(' ', array_slice($words, 0, 20));
            mysqli_stmt_close($selectStmt);
        }
		?>
		<a href="single-news.php?id=<?php echo $Id; ?>">

		<div class="col-div-6">
				<div class="box-1">
				<img src="uploads/<?php echo $Image; ?>" class="b-img">
				<h3 class="heading1"><?php echo $Category; ?></h3>
				<p class="blog-heading"><?php echo $ArticleName; ?></p>
				<p class="text"><?php echo $first20Words; ?>....</p>
				<span class="name"><?php echo $Name; ?> . <?php echo $Date; ?></span>
		</div>
			</div>
	</a>
		<div class="col-div-6">
		<?php 

		// Select the articles from the 2nd latest to the 6th latest
$selectQuery = "SELECT * FROM Articles ORDER BY Id DESC LIMIT 1, 3";
$selectStmt = mysqli_prepare($con, $selectQuery);

if ($selectStmt) {
    // Execute the statement
    if (mysqli_stmt_execute($selectStmt)) {
        // Retrieve the result
        $result = mysqli_stmt_get_result($selectStmt);

        // Check if the result has rows
        if (mysqli_num_rows($result) > 0) {
            // Loop through the rows
            while ($row = mysqli_fetch_assoc($result)) {
                // Retrieve the variables
				$Id = $row['Id'];

                $ArticleName1 = $row['ArticleName'];
                $Message = $row['Message'];
                $Email = $row['Email'];
                $Name1 = $row['Name'];
                $AuthorImage = $row['AuthorImage'];
                $Date1 = $row['Date'];
                $Category1 = $row['Category'];
                $Image1 = $row['Image'];

                // Now you can use these variables as needed
                // ...
				$words = explode(' ', $Message);

				// Get the first 20 words
				$first20Words1 = implode(' ', array_slice($words, 0, 20));

		?>
		<a href="single-news.php?id=<?php echo $Id; ?>">

					<div class="lr-box">

			<div class="col-div-6">
				<h3 class="heading1"><?php echo $Category1; ?></h3>
				<p class="blog-heading-1"><?php echo $ArticleName1; ?></p>
				<p class="text"><?php echo $first20Words1; ?>....</p>
				<span class="name"><?php echo $Name1; ?> . <?php echo $Date; ?></span>
			</div>
			<div class="col-div-6">
				<img src="uploads/<?php echo $Image1; ?>" class="b-img-1">
			</div>
			<div class="clearfix"></div>
			<hr class="line">
			</div>
			</a>
			
<?php 

}
}
}
mysqli_stmt_close($selectStmt);
}?>


			

		<div class="clearfix"></div>
	</div>
</section>

<br><br>


<section id="latest">
	<div class="container" style="text-align:center;">
		<h3>Latest stories</h3>
		<br>
		
<?php

$selectQuery = "SELECT * FROM Articles";
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





<section class="foot-section">
	<div class="container">
		<div class="foot-inner">
		<h1 class="heading" style="margin: 0px;">Explore Trending News</h1>
		</div>
	</div>
</section>

<footer>
	<div class="container">
		<p>Copyright@ News Desk | Developed by <a style="color: rgb(115, 146, 173);" href="https://hanannawaz.com">Abdul Hanan Nawaz</a> & Team</p>
	</div>
</footer>

</body>
</html>