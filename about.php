<?php
$alert = false;
$showError = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate input fields
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['message'])) {
        $showError = true;
        $errorMsg = "Please fill in all fields.";
    } else {
        // Validate email address
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $showError = true;
            $errorMsg = "Please enter a valid email address.";
        } else {
            // Connecting to the Database
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "db";

            // Create a connection
            $conn = mysqli_connect($servername, $username, $password, $database);

            // Die if connection was not successful
            if (!$conn) {
                die("Sorry we failed to connect: " . mysqli_connect_error());
            } else {
                // Submit these to a database
                // Sql query to be executed 
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $message = $_POST['message'];
                $sql = "INSERT INTO `contacts` (`name`, `email`, `phone`, `message`) VALUES ('$name', '$email','$phone','$message')";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    $alert = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Success!</strong> Your entry has been submitted successfully!
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>';
                } else {
                    $showError = true;
                    $errorMsg = "Sorry, there was an error submitting your form. Please try again later.";
                }
            }
        }
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Best Online Food Delivery Service in India | Big Foody.com</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" media="screen and (max-width: 1170px)" href="phone.css">
    <link href="https://fonts.googleapis.com/css?family=Baloo+Bhai|Bree+Serif&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>


    <nav id="navbar">
        <div id="logo">
            <img src="data:image/png;base64,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" alt="MyOnlineMeal.com">
        </div>
        <ul>
            <li class="item"><a href="index.html">Home</a></li>
            <li class="item"><a href="index.html#services-container">Services</a></li>
            <li class="item"><a href="index.html#client-section">Our Clients</a></li>
            <li class="item"><a href="#contact">Contact Us</a></li>
            <form class="form-inline my-2 my-lg-0 ml-5">
            <input class="form-control mr-sm-2 ml-5" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
             </form>
        </ul>
    </nav>


    <section id="contact">
        <h1 class="h-primary center">Contact Us</h1>
        <div id="contact-box">
            <form action="about.php" method="post">
                <?php
                
                if ($showError==true) {
                    echo $showError;
                    
                }
                else
                {
                    
                    echo $alert;
                }
                if ($showError) {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Error!</strong> Please fill in all the fields.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>';
                }
                
                ?>
                
                <div class="form-group">
                    <label for="name">Name: </label>
                    <input type="name" name="name" id="name" placeholder="Enter your name" >
                </div>
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="email" name="email" id="email" placeholder="Enter your email">
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number: </label>
                    <input type="phone" name="phone" id="phone" placeholder="Enter your phone">
                </div>
                <div class="form-group">
                    <label for="message">Message: </label>
                    <textarea name="message" id="message" cols="30" rows="10"></textarea>
                </div>
                <div class="center" ><button type="submit" class="btn" >Submit</button></div>
                
            </form>
        </div>
    </section>

    <footer>
        <div class="center">
            Copyright &copy; satywanbhalekar@gmail.com. All rights reserved!
        </div>
    </footer>
</body>

</html>

