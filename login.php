<?php
session_start();

$errormessage="";
$email="";
if ($_SERVER["REQUEST_METHOD"] == "POST")
 {

  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "db_dishdiscoveries";
 
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) 
  {
      die("Connection failed: " . $conn->connect_error);
  }
   

    $email = $_POST['Email'];
    $password = $_POST['Password'];


    $statement = $conn->prepare("SELECT * FROM tbl_users WHERE Email = ?");
    $statement->bind_param("s", $email);
    $statement->execute();
    $result = $statement->get_result();

    if ($result->num_rows == 1) 
    {
        $row = $result->fetch_assoc();
        // Verify password
        if (password_verify($password, $row['Password'])) 
        {
            // Successful login - store session variables
            $_SESSION['UserID'] = $row['ID'];
            $_SESSION['FirstName'] = $row['FirstName'];
            $_SESSION['LastName'] = $row['LastName'];
            $_SESSION['Email'] = $row['Email'];
            $statement->close();
            $conn->close();
            // Redirect to dashboard or home page
            header("Location: index.php?action=login");
            exit();
        } 
        else
        {
          $errormessage="Invalid Password.";
        }
    }
    else
    {
        // Email not found
        $errormessage="Account not found.";
    }
    $statement->close();
    $conn->close();

    
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="images/icon" href="Images\Dish Discoveries Logo.png">
        <title>Dish Discoveries - Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <style>
            #loginform
            {
                
                margin-bottom: 110px;
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
                    <a class="nav-link" href="contact_us.php">Contact Us</a>
                </li>
                
            </ul>
        
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
          
        </div>
    </div>
</nav>

     <div class="container">
     <div class="row justify-content-center">
        <div class="col-lg-5 col-md-8 text-center mb-4" style="margin-top:40px">
            <h2 class="fw-bold">Login Form</h2>
        </div>
    </div>
      <form id="loginform" method="POST" action="login.php">

       <?php 
        if($errormessage!="")
        {
          echo ('<div class="row justify-content-center"><div class="alert alert-danger row col-lg-5 col-md-8" role="alert" id="errorAlert">'.$errormessage.'</div></div>');
        }
       ?>
        <!-- Email input -->
        <div class="row justify-content-center">
        
          <div data-mdb-input-init class="form-outline mb-4 col-lg-5 col-md-8">
            <input type="email" id="Email" name="Email" class="form-control" placeholder="Email Address" value="<?php echo !empty($email) ? $email : ''; ?>" required />
          </div>
        </div>
      
        <!-- Password input -->
        <div class="row justify-content-center">
  
          <div data-mdb-input-init class="form-outline mb-4 col-lg-5 col-md-8">
            <input type="password" id="Password" name="Password" class="form-control" placeholder="Password" required />
          </div>
        </div>
    
      
        <!-- Submit button -->
        <div class="row justify-content-center">
          
          <div class="col-lg-5 col-md-8">
            <button  class="btn  w-100 mb-4" style="background-color: #ff914d; " type="submit">Sign in</button>
          </div>
        </div>
      
        <!-- Signup Section -->
        <div class="row justify-content-center">
          <div class="col-lg-5 col-md-8 text-center">
            <p class="mb-0">Don't have an account?</p>
            <a href="signup.php" class="btn  text-decoration-none fw-bold " style="color:#ff914d;">
              Create Account
            </a>
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
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
  setTimeout(function() {
    document.getElementById("errorAlert").style.display = "none";
  }, 3000); 
</script>
</html>