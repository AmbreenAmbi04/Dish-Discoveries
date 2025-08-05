<?php 
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="images/icon" href="Images\Dish Discoveries Logo.png">
    <title>Dish Discoveries - About Us</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
 body {
                background-color: #f8f9fa;
                font-family: Arial, sans-serif;
            }
            .section-header {
                
                margin-bottom: 20px;
                font-size: 2rem;
                font-weight: bold;
            }
            .about-content {
             
                background-image: url('images/Banner1.png'); 
    background-size: cover; 
    background-position: center; 
    padding: 50px 0; 
   
            }
            .card {
                border: none;
                box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
                    <a class="nav-link active" href="about_us.php">About Us</a>
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

<!-- About Section -->
<div class="container about-content">
    <div class="row justify-content-center" style="color:white">
        <div class="col-lg-8 col-md-10 col-sm-12 text-center">
            <h2 class="section-header">Welcome to Dish Discoveries</h2>
            <p>At Dish Discoveries, we believe that food is not just about eating—it's about discovering, sharing, and connecting through unique and diverse culinary experiences. Whether you're a seasoned chef or someone who loves experimenting in the kitchen, our platform provides you with a space to explore new recipes, share your culinary creations, and learn from others!</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="section-header">Our Mission</h4>
                    <p>Our mission is to build a community of food enthusiasts who can share their recipes, cooking tips, and food stories. We want to inspire people to discover new dishes, try out exciting flavors, and bring people together around the table, one recipe at a time.</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="section-header">How It Works</h4>
                    <p>Getting started with Dish Discoveries is easy:</p>
                    <ol>
                        <li><strong>Sign Up:</strong> Create an account to get started.</li>
                        <li><strong>Post Recipes:</strong> Share your favorite dishes with the community!</li>
                        <li><strong>Explore:</strong> Browse through recipes by category or ingredient to discover new flavors.</li>
                        
                    </ol>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="section-header">Join Our Community</h4>
                    <p>Dish Discoveries is not just a recipe-sharing platform—it's a community of people passionate about food. We invite you to join us and start exploring new dishes today. Whether you're looking to try something new, share your culinary creations, or connect with other food enthusiasts, we have a space for you.</p>
                    <?php 
          if (!isset($_SESSION['UserID'])) 
          {
            echo ('<a href="signup.php" class="btn btn-lg" style="background-color:#ff914d; color:black;">Create Account</a>');
          }
          ?> 
                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="footer-container bg-light fs-1 d-flex justify-content-center align-items-center">
        <i class="bi bi-instagram me-3"></i>
        <i class="bi bi-youtube me-3"></i>
        <i class="bi bi-twitter-x me-3"></i>
        <i class="bi bi-facebook"></i>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

   
  </body>
</html>
