<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $db_name = "db_dishdiscoveries";
    
    // Database connection
    $connection = new mysqli($serverName, $userName, $password, $db_name);
    if ($connection->connect_error)
     {
        die("Connection failed: " . $connection->connect_error);
    }
    $id=$_POST["recipe_id"];
    $sql="DELETE from tbl_recipesharing where id=?";
    $stmt = $connection->prepare($sql);
    if ($stmt) 
    {
        $stmt->bind_param("i", $id);      
        if ($stmt->execute()) 
        {
            
        }       
       
    } 
    $connection->close();
    $stmt->close();

}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="images/icon" href="Images\Dish Discoveries Logo.png">
        <title>Dish Discoveries - My Recipes</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <style>
            #loginform
            {
                margin-bottom: 110px;
            }
        .card-img-overlay {
            transition: background-color 0.3s ease;
        }
        .card:hover .card-img-overlay {
            background-color: rgba(0, 0, 0, 0.7);
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
                    <a class="nav-link active" href="yourrecipe.php">Your Recipes</a>
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
<?php 
     
$serverName = "localhost";
$userName = "root";
$password = "";
$db_name = "db_dishdiscoveries";

$connection = new mysqli($serverName, $userName, $password, $db_name);

if ($connection->connect_error) 
{
    die("Connection failed: " . $connection->connect_error);
}
$userid=$_SESSION["UserID"];
$query="select * from tbl_recipesharing where userid=$userid";
$result=$connection->query($query);
if($result->num_rows>0)
{
    echo '<div class="container">
                <h2 class="mt-4 mb-4">Your Recipes</h2>
    <div class="row mb-4">'; 
                while ($row = $result->fetch_assoc())
                 {
                    $title = htmlspecialchars($row['recipetitle']);
                    $image = htmlspecialchars($row['titlerecipeimage']);
                    $description = htmlspecialchars($row['recipedescription']);
                    $ingredients = htmlspecialchars($row['keyrecipeingredients']);
                    $ingredientList = implode(", ", array_slice(explode(" ", $ingredients), 0, 4));
                    $id=$row["id"];
                    echo "
                    <div class='col-md-4 mb-4'>
                        <div class='card'>
                        
                            <img src='$image' class='card-img-top card-img-hover' width='200px' height='300px'>
                            <div class='card-img-overlay text-white'>
                                <h5 class='display-6'>$title</h5>
                                <p class='lead'>$description</p>
                                <h6 class='card-footer'>$ingredientList</h6>
                            </div>
                            
                            <div class='card-footer text-center' style='z-index:100'>
                            <form action='recipe_edit.php' method='POST' style='display: inline;'>
                            <input type='hidden' name='recipe_id' value='$id'>
                            <a href='edit_recipe.php?id=$id' class='btn btn-lg me-2' style='background-color: #ff914d;'>Edit</a>
                            </form>
                             <form action='yourrecipe.php' method='POST' style='display: inline;'>
                             <input type='hidden' name='recipe_id' value='$id'>
                            <button type='submit' class='btn btn-danger btn-lg'>Delete</button>
                            </form>
                             </div>
                        </div>
                    </div>";
                }
            
            
        echo '</div></div>';
        $connection->close();
}
else
{
    echo "<p style='padding-left:115px'>No Recipes found.</p>";
    $connection->close();
}

?>   
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
    
</html>