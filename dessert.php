<?php
session_start();
$serverName="localhost";
$userName="root";
$password="";
$db_name="db_dishdiscoveries";

$connection = new mysqli($serverName, $userName, $password, $db_name);

if ($connection)
{
    if (isset($_GET['ingredient']) && !empty($_GET['ingredient'])) {
        $ingredient = $connection->real_escape_string($_GET['ingredient']);
        $query = "SELECT recipetitle, recipeimage, recipedescription, recipeingredients, recipeinstructions 
                  FROM tbl_recipesharing 
                  WHERE LOWER(recipecategory)='dessert' AND LOWER(recipeingredients) LIKE '%$ingredient%'";
    } else {
        $query = "SELECT recipetitle, recipeimage, recipedescription, recipeingredients, recipeinstructions 
                  FROM tbl_recipesharing WHERE LOWER(recipecategory)='dessert'";
    }

    $result = $connection->query($query);
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="images/icon" href="Images\Dish Discoveries Logo.png">
    <title>Dish Discoveries - Dessert</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.min.css">
    <style>
    .star{
      cursor: pointer;
      color: #ccc;
    }
    .star.selected{
      color: gold;
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
                    <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Recipes
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="main_course.php">Main Course</a></li>
                        <li><a class="dropdown-item" href="dessert.php#<?php echo $id; ?>">Dessert</a></li>
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
            <form class="d-flex" role="search" method="GET" action="">
                <input class="form-control me-2" type="text" name="ingredient" placeholder="Search" aria-label="Search">
                <button class="btn" type="submit" style="background-color:#ff914d">Search</button>
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
        </div>
    </div>
</nav>

    <!--Dessert Recipes-->
    <div class="container">
        <h2 class="mb-3">Dessert - Recipes</h2>
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $title = htmlspecialchars($row['recipetitle']);
                    $image = htmlspecialchars($row['recipeimage']);
                    $description = htmlspecialchars($row['recipedescription']);
                    $ingredients = htmlspecialchars($row['recipeingredients']);
                    $instructions = htmlspecialchars($row['recipeinstructions']);

                    $ingredientlist = explode('<br><br>', $ingredients);
                    $instructionlist = explode('<br><br>', $instructions);

                    echo "
                    <div class='col-md-6 mb-4'>
                        <div class='card'>
                            <h3 class='card-title mt-2 ms-3'>$title</h3>
                            <img src='$image' class='card-img-top' width='300px' height='270px'>
                            <ul class='list-group list-group-flush ms-4'>
                                <h4 class='mt-2'>Ingredients</h4>";
                                foreach ($ingredientlist as $ingredient) {
                                    echo "<li class='list-group-items'>" . htmlspecialchars($ingredient) . "</li>";
                                }
                                echo "
                            </ul>
                            <div class='card-body'>
                                <h5 class='card-title'>Instructions</h5>
                                <p class='card-text'>";
                                foreach ($instructionlist as $instruction) {
                                    echo htmlspecialchars($instruction) . "<br>";
                                }
                                echo "</p>
                            </div>
                        </div>
                    </div>";
                }
            } else {
                echo "<p>No recipes found matching your search.</p>";
            }
            ?>
        </div>
    </div>
     <hr>
    <!--Review Section-->
    <?php 
        if(isset($_SESSION['UserID']))
        {
          echo('<div class="container mt-5 mb-3">
          <h2 class="fw-bold">Leave a Review</h2>
          <form class="form" action="" method="post">
            <label class="form-label fw-bold fs-4" for="reviewtitle">Review Title</label>
            <input type="text" name="reviewtitle" id="reviewtitle" required class="form-control">
            <div class="mt-2">
            <h2 class="fw-bold fs-4">Rating</h2>
            <div id="ratingContainer" class="fs-2" role="radiogroup" aria-labelledby="ratingInput">
              <span class="star" data-value="1" aria-label="1 star">&#9733;</span>
              <span class="star" data-value="2" aria-label="2 stars">&#9733;</span>
              <span class="star" data-value="3" aria-label="3 stars">&#9733;</span>
              <span class="star" data-value="4" aria-label="4 stars">&#9733;</span>
              <span class="star" data-value="5" aria-label="5 stars">&#9733;</span>
              </div>
              <input type="hidden" name="ratingInput" id="ratingInput" required>
            </div>
            <label class="form-label fw-bold fs-4" for="review">Review</label>
            <textarea rows="4" name="review" required class="form-control" id="review"></textarea>
            <button class="btn mt-3 fw-bold" style="background-color: #ff914d" type="submit">Submit Review</button>
          </form>
          </div><hr>');
        }
    ?>

    <!--Display Reviews--> 
    <div id="reviewcontainer">
      <h2 class="fw-bold" style="padding-left:115px">Reviews</h2>
      <?php
      //Review's Section
      if ($_SERVER['REQUEST_METHOD'] === 'POST')
      {
        $reviewtitle = htmlspecialchars($_POST['reviewtitle']);
        $rating = (int)($_POST['ratingInput']);
        $review = htmlspecialchars($_POST['review']);
        $created_at = date('Y-m-d H:i:s');
        $userid=$_SESSION['UserID'];
        
      $sql="INSERT INTO tbl_dessertreviews (reviewtitle, rating, review, created_at,user_id) VALUES ('$reviewtitle', '$rating',
      '$review', '$created_at','$userid')";
      if ($connection->query ($sql) === TRUE)
      {
        
      }
    }
      $review = "SELECT reviewtitle, rating, review, created_at,user_id FROM tbl_dessertreviews ORDER BY created_at DESC LIMIT 3";
      $reviewresult = $connection -> query($review);
    
      if ($reviewresult->num_rows > 0) {
    while($row = $reviewresult->fetch_assoc())
    {
      $reviewtitle = htmlspecialchars($row['reviewtitle']);
        $rating = (int)($row['rating']);
        $review = htmlspecialchars($row['review']);
        $created_at = $row['created_at']; 
        $userid=$row['user_id'];
        $name="";
        if(isset($userid) && $userid!=0)
        {
             $userquery = "select * from tbl_users where ID=$userid";
             $userresult=$connection->query($userquery);
             if($userresult->num_rows>0)
             {
                   $userrow=$userresult->fetch_assoc();
                   $fName=$userrow["FirstName"];
                   $lName=$userrow["LastName"];
                   $name=$fName." ".$lName;

             }
            
        }      

    echo "
    <div class='container'>
        <div class='card mb-3'>
            <div class='card-body'>
                <h5 class='card-title fw-bold'>$reviewtitle</h5>
                <p class='card-text'>" . str_repeat("&#9733;", $rating) . str_repeat("&#9734;", 5 - $rating) . "</p>
                <p class='card-text'>$review</p>
                <p class='card-text text-muted'><small>Posted on: $created_at</small></p>
                
            
    ";
    if(isset($name) && $name!="")
    {
      echo "<p class='card-text text-muted'><small>Posted By: $name</small></p>";
    }
    echo "</div>
        </div>
    </div>";
    }
    
} else {
    echo "<p style='padding-left:115px'>No reviews yet.</p>";
}

        $connection->close();
      ?>


    <!--Footer-->
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
      document.addEventListener('DOMContentLoaded', () => {
      const stars = document.querySelectorAll('#ratingContainer .star');
      const ratinginput = document.getElementById('ratingInput');

      stars.forEach((star, index) => {
        star.addEventListener('click', () => {
            const rating = index + 1;
            ratingInput.value = rating;
        
            //Highlighting the selected stars
            stars.forEach((s, i) => {
                s.classList.toggle('selected', i < rating);
            });
        });
    });
});
    </script>
  </body>
</html>
