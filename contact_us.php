<?php
session_start();

$successMessage = "";
$errorMessage = "";
$errors = [];
$name="";
$email="";
$subject="";
$message="";
// Process the form if submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $subject = $_POST['Subject'];
    $message = $_POST['Message'];
    if(empty($email))
    {
      $errors['Email'] = "Email is required.";
    }
    else
    {  
      if (!filter_var($email, FILTER_VALIDATE_EMAIL))
      {
          $errors['Email'] = "Invalid email format.";
      }

    }

  if (empty($name)) {
      $errors['Name'] = "Name is required.";
  }
  if (empty($subject)) {
    $errors['Subject'] = "Subject is required.";
}
  if (empty($message)) {
      $errors['Message'] = "Message is required.";
  }

    if(empty($errors))
    {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_dishdiscoveries";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $stmt = $conn->prepare("INSERT INTO tbl_contactus (Name, Email, Subject, Message, CreatedDate) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        $successMessage = "Your message has been sent successfully!";
        $errors = [];
        $name="";
        $email="";
        $subject="";
        $message="";
    } else {
        $errorMessage = "There was an error submitting your message. Please try again.";
    }

    $stmt->close();
    $conn->close();
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="images/icon" href="Images/Dish Discoveries Logo.png">
    <title>Dish Discoveries - Contact Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        #contactform {
            margin-bottom: 110px;
        }
        .errortxt
            {
              margin-left:5px;
              margin-top:3px;
            }
    </style>
</head>
<body>
<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <img src="Images/Dish Discoveries Logo.png" style="border-radius:250px" width="60px" height="60px">
        <a class="navbar-brand ms-2" href="index.php">Dish Discoveries</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
                </li>
                
                <?php 
          if (isset($_SESSION['UserID'])) 
          {
            echo ('<li class="nav-item">
            <a class="nav-link" href="write_a_recipe.php">Write a Recipe</a>
            </li>');
          }
          ?> 
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Recipes
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="main_course.php">Main Course</a></li>
                        <li><a class="dropdown-item" href="dessert.php">Dessert</a></li>
                    </ul>
                </li>
                <?php 
                if(isset($_SESSION["UserID"]))
                {
                echo '<li class="nav-item">
                    <a class="nav-link" href="yourrecipe.php">Your Recipes</a>
                </li>';
                }
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="about_us.php">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="contact_us.php">Contact Us</a>
                </li>
                
            </ul>
            <form class="d-flex" role="search" method="GET" action="">
                <?php 
          if (!isset($_SESSION['UserID'])) 
          {
          echo ('<a href="login.php" class="btn ms-3" style="background-color: #ff914d; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
            Login
          </a>');
          }
          else
          {
            echo ('<a href="logout.php" class="btn ms-3" style="background-color: #ff914d; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
            Logout
          </a>');

          }

          ?>
            </form>
             <!-- Toast Notification -->
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
          <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header" style="background-color: rgb(151, 238, 151)">
              <i class="bi bi-check2-circle fs-3 me-2" style="color: green"></i>
              <strong class="me-auto fs-5 fw-lightbold" id="toast-title"></strong>
              <small class="muted">Just now</small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body" id="toast-body">
              
            </div>
          </div>
        </div>
        </div>
    </div>
</nav>

<!-- Contact Form -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8 text-center mb-4" style="margin-top:40px">
            <h2 class="fw-bold">Contact Us</h2>
        </div>
    </div>
    <form id="contactform" method="POST" action="contact_us.php">
        <?php
        if ($successMessage) {
            echo ('<div class="alert alertmsg alert-success text-center col-lg-5 mx-auto">' . $successMessage . '</div>');
        }
        if ($errorMessage) {
            echo ('<div class="alert alertmsg alert-danger text-center col-lg-5 mx-auto">' . $errorMessage . '</div>');
        }
        ?>
        <div class="row justify-content-center">
            <div class="form-outline mb-4 col-lg-5 col-md-8">
                <input type="text" id="Name" name="Name" class="form-control" placeholder="Your Name" required value="<?php echo !empty($name) ? $name : ''; ?>" />
                <?php 
       if (!empty($errors['Name']))
       {
          echo('<div class="text-danger errortxt">'.$errors['Name'].'</div>');
       }
       ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="form-outline mb-4 col-lg-5 col-md-8">
                <input type="email" id="Email" name="Email" class="form-control" placeholder="Your Email" required value="<?php echo !empty($email) ? $email : ''; ?>"/>
                <?php 
       if (!empty($errors['Email']))
       {
          echo('<div class="text-danger errortxt">'.$errors['Email'].'</div>');
       }
       ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="form-outline mb-4 col-lg-5 col-md-8">
                <input type="text" id="Subject" name="Subject" class="form-control" placeholder="Subject" required value="<?php echo !empty($subject) ? $subject : ''; ?>"/>
                <?php 
       if (!empty($errors['Subject']))
       {
          echo('<div class="text-danger errortxt">'.$errors['Subject'].'</div>');
       }
       ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="form-outline mb-4 col-lg-5 col-md-8">
                <textarea id="Message" name="Message" class="form-control" rows="5" placeholder="Your Message" required value="<?php echo !empty($message) ? $message : ''; ?>"></textarea>
                <?php 
       if (!empty($errors['Message']))
       {
          echo('<div class="text-danger errortxt">'.$errors['Message'].'</div>');
       }
       ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <button class="btn w-100 mb-4" style="background-color: #ff914d;" type="submit">Submit</button>
            </div>
        </div>
    </form>
</div>

<footer class="footer">
    <div class="footer-container bg-light fs-1 d-flex justify-content-center align-items-center">
        <i class="bi bi-instagram me-3"></i>
        <i class="bi bi-youtube me-3"></i>
        <i class="bi bi-twitter-x me-3"></i>
        <i class="bi bi-facebook"></i>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  setTimeout(function() {
    document.getElementsByClassName("alertmsg")[0].style.display = "none";
  }, 3000); 
</script>
</body>
</html>
