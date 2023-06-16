<!DOCTYPE html>
<html>
<head>
	<title>SignIn / SignUp - NewsDesk</title>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
<link rel="icon" type="image/x-icon" href="assets/imgs/NewsDesk.png">
</head>


<?php

include('Connection/connection.php');

if(isset($_POST['btnSignUp'])) {
    // Check if a file was uploaded
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $image = $_FILES['image'];

        $targetDirectory = 'uploads/';

        $fileName = uniqid() . '_' . $image['name'];

        $targetPath = $targetDirectory . $fileName;
        if(move_uploaded_file($image['tmp_name'], $targetPath)) {
            // File was successfully uploaded, save the file path in the database

            $Name = $_POST['txtName'];
            $Email = $_POST['txtEmail'];
            $Password = $_POST['txtPassword'];

            // Database connection details
           

            $query = "INSERT INTO Users (Email, Name, Password, Image, Status, Role) VALUES ('$Email', '$Name', '$Password', '$fileName', 'Active', 1)";
            if (mysqli_query($con, $query)) {
                echo '<script type="text/javascript">';
                echo 'alert("User Created Successfully.");';
                echo '</script>';
            } else {
                echo '<script type="text/javascript">';
                echo 'alert("Error!! User not Created.");';
                echo '</script>';
            }

            // Close the database connection
            mysqli_close($con);
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Error uploading the file.");';
            echo '</script>';
        }
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("No file was uploaded or an error occurred.");';
        echo '</script>';
    }
}

// if (isset($_COOKIE['email'])) {
//     $email = $_COOKIE['email'];
//     header("Location: Dashboard/dashboard.php");
// } 

if (isset($_POST['btnSignIn'])) {
    $Email = $_POST['txtEmail'];
    $Password = $_POST['txtPassword'];

    // Database connection details
    // ...

    $query = "SELECT * FROM Users WHERE Email = '$Email' AND Password = '$Password' AND Status='Active'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        session_start();
        $_SESSION['email'] = $Email;

        $row = mysqli_fetch_assoc($result);
        $name = $row['Name'];
        $image = $row['Image'];
        $role = $row['Role'];
    
        $_SESSION['name'] = $name;
        $_SESSION['role'] = $role;
        $_SESSION['image'] = $image;
        
        header("Location: Dashboard/dashboard.php");

       // setcookie('email', $Email, time() + (86400 * 30), '/'); // Cookie lasts for 30 days

        exit();
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Invalid email or password.");';
        echo '</script>';
    }

    mysqli_close($con);
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
    

	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">

			<div class="signup">
            <form method="POST" action="" enctype="multipart/form-data">
                <label for="chk" aria-hidden="true">SignIn</label>
                <p class="label"> Sign Up</p>
					<input type="text" name="txtName" placeholder="Name" required>
					<input type="email" name="txtEmail" placeholder="Email" required>
					<input type="password" name="txtPassword" placeholder="Password" required>
					<input type="file" name="image" value="" required>
					<button type="submit" class="button" style="text-align: center;" name="btnSignUp">Sign up </button>

				</form>
			</div>

			<div class="login">
            <form method="Post">
					<label for="chk" aria-hidden="true">SignIn</label>
					<input type="email" name="txtEmail" placeholder="Email" required>
					<input type="password" name="txtPassword" placeholder="Password" required>
					<input class="button" type="Submit" style="text-align: center;" Value="Sign in" name="btnSignIn"/>
				</form>
			</div>
	</div>

    

    <footer>
        <div class="container">
          <p>Copyright@ News Desk | Developed by <a style="color: rgb(115, 146, 173);" href="https://hanannawaz.com">Abdul Hanan Nawaz</a> & Team</p>
        </div>
      </footer>
</body>
</html>