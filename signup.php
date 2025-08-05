<?php
session_start();
$errors = [];
$firstname="";
$lastname="";
$email="";
$phone="";
$password="";
$gender="";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    // Retrieve form data
    $firstname = $_POST['FirstName'];
    $lastname = $_POST['LastName'];
    $email = $_POST['Email'];
    $phone = $_POST['PhoneNumber'];
    $password = $_POST['Password'];
    $gender= $_POST['Gender'];
    if(empty($password))
    {
      $errors['Password'] = "Password is required.";
    }
    else
    {
    if (strlen($password) < 8)
     {
      $errors['Password'] = "Password must be at least 8 characters long.";
     }
    }

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

  if (empty($firstname)) {
      $errors['FirstName'] = "First name is required.";
  }
  if (empty($gender)) {
    $errors['Gender'] = "Gender is required.";
}
  if (empty($lastname)) {
      $errors['LastName'] = "Last name is required.";
  }
  if(empty($phone))
  {
    $errors['PhoneNumber'] = "Phone is required.";
  }
  else
  {
  if (!preg_match('/^[0-9]{11}$/', $phone)) {
      $errors['PhoneNumber'] = "Phone number must contain 11 digits.";
  }
}


    if(empty($errors))
    {
    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db_dishdiscoveries";
   
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) 
    {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $statement = $conn->prepare("SELECT * FROM tbl_users WHERE Email = ?");
          $statement->bind_param("s", $email);
          $statement->execute();
          $result = $statement->get_result();

          if ($result->num_rows == 1) 
          {
            $errors['Email'] = "Email Address already in use.";
            $statement->close();
            $conn->close();
          }
          else
          {

    $statement = $conn->prepare("INSERT INTO tbl_users (FirstName, LastName, Email, Phone, Gender, Password) VALUES (?, ?, ?, ?, ?, ?)");
    $statement->bind_param("ssssss", $firstname, $lastname, $email, $phone, $gender, $hashed_password);

    // Execute the query and check for success
    if ($statement->execute()) 
    {
        // Successful login - store session variables
        $user_id = $conn->insert_id;

        $_SESSION['UserID'] = $user_id;
        $_SESSION['FirstName'] = $firstname;
        $_SESSION['LastName'] = $lastname;
        $_SESSION['Email'] = $email;
        $statement->close();
        $conn->close();
        // Redirect to dashboard or home page
        header("Location: index.php?action=signup"); 
        exit();
    } 
    else 
    {
      $errors["DB"]="Error in DB";
    }
    $statement->close();
    $conn->close();
  }

    
  }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="images/icon" href="Images\Dish Discoveries Logo.png">
        <title>Dish Discoveries - Sign Up</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <style>
            #loginform
            {
             
                margin-bottom: 100px;
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
            <h2 class="fw-bold">Sign Up Form</h2>
        </div>
    </div>
      <form id="loginform" method="POST" action="signup.php">
      <?php 
        if(!empty($errors["DB"]))
        {
          echo ('<div class="row justify-content-center"><div class="alert alert-danger row col-lg-5 col-md-8" role="alert" id="errorAlert">Error while adding record in DB.</div></div>');
        }
       ?>

      <div class="row justify-content-center">    
      <div data-mdb-input-init class="form-outline mb-4 col-lg-5 col-md-8">
        <input type="text" id="FirstName" name="FirstName" class="form-control" placeholder="First Name" value="<?php echo !empty($firstname) ? $firstname : ''; ?>" />
       <?php 
       if (!empty($errors['FirstName']))
       {
          echo('<div class="text-danger errortxt">'.$errors['FirstName'].'</div>');
       }
       ?>
      </div>
      </div>

      <div class="row justify-content-center">    
      <div data-mdb-input-init class="form-outline mb-4 col-lg-5 col-md-8">
        <input type="text" id="LastName" name="LastName" class="form-control" placeholder="Last Name" value="<?php echo !empty($lastname) ? $lastname : '';?>"/>
        <?php 
       if (!empty($errors['LastName']))
       {
          echo('<div class="text-danger errortxt">'.$errors['LastName'].'</div>');
       }
       ?>
      </div>
      </div>


      <div class="row justify-content-center">    
    <div data-mdb-input-init class="form-outline mb-4 col-lg-5 col-md-8">
      <select id="Gender" name="Gender" class="form-select">
        <option value="">Select Gender</option>
        <option value="Male" <?php echo($gender=="Male"?'selected':'') ?>>Male</option>
        <option value="Female" <?php echo($gender=="Female"?'selected':'') ?>>Female</option>
        <option value="Other" <?php echo($gender=="Other"?'selected':'') ?>>Other</option>
      </select>
      <?php 
       if (!empty($errors['Gender']))
       {
          echo('<div class="text-danger errortxt">'.$errors['Gender'].'</div>');
       }
       ?>
    </div>
  </div>



      
        <!-- Email input -->
        <div class="row justify-content-center">
      
          <div data-mdb-input-init class="form-outline mb-4 col-lg-5 col-md-8">
            <input type="email" id="Email" name="Email" class="form-control" placeholder="Email Address" value="<?php echo !empty($email) ? $email : ''; ?>"/>
            <?php 
       if (!empty($errors['Email']))
       {
          echo('<div class="text-danger errortxt">'.$errors['Email'].'</div>');
       }
       ?>
          </div>
        </div>
      
        <div class="row justify-content-center">    
      <div data-mdb-input-init class="form-outline mb-4 col-lg-5 col-md-8">
        <input type="text" id="PhoneNumber" name="PhoneNumber" class="form-control" placeholder="Phone Number" value="<?php echo !empty($phone) ? $phone : ''; ?>"/>
        <?php 
       if (!empty($errors['PhoneNumber']))
       {
          echo('<div class="text-danger errortxt">'.$errors['PhoneNumber'].'</div>');
       }
       ?>
      </div>
      </div>

        <!-- Password input -->
        <div class="row justify-content-center">
          <div data-mdb-input-init class="form-outline mb-4 col-lg-5 col-md-8">
            <input type="password" id="Password" name="Password" class="form-control" placeholder="Password"/>
            <?php 
       if (!empty($errors['Password']))
       {
          echo('<div class="text-danger errortxt">'.$errors['Password'].'</div>');
       }
       ?>
          </div>
        </div>
    
      
        <!-- Submit button -->
        <div class="row justify-content-center">
          
          <div class="col-lg-5 col-md-8">
            <button  class="btn w-100 mb-4" style="background-color: #ff914d; " type="submit">Sign Up</button>
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