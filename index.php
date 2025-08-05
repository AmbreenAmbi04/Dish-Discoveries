<?php
session_start();
$serverName = "localhost";
$userName = "root";
$password = "";
$db_name = "db_dishdiscoveries";

$connection = new mysqli($serverName, $userName, $password, $db_name);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Search Feature Code
$searchResult = [];
$isSearch = isset($_GET['ingredient']) && !empty(trim($_GET['ingredient']));

if ($isSearch) {
    $ingredient = $connection->real_escape_string($_GET['ingredient']);
    $searchquery = "SELECT recipetitle, titlerecipeimage, recipedescription, keyrecipeingredients FROM tbl_recipesharing WHERE keyrecipeingredients LIKE '%$ingredient%'";
    $result = $connection->query($searchquery);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $searchResult[] = $row;
        }
    }
} else {
    // Fetching Main Course Recipes
    $mainCourseQuery = "SELECT recipetitle, titlerecipeimage, recipedescription, keyrecipeingredients FROM tbl_recipesharing WHERE recipecategory = 'maincourse'";
    $mainCourseResult = $connection->query($mainCourseQuery);

    // Fetching Dessert Recipes
    $dessertQuery = "SELECT recipetitle, titlerecipeimage, recipedescription, keyrecipeingredients FROM tbl_recipesharing WHERE recipecategory = 'dessert'";
    $dessertResult = $connection->query($dessertQuery);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dish Discoveries - Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
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
                    <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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

<?php if ($isSearch): ?>
    <!-- Search Results Section -->
    <div class="container mt-4">
        <?php if (!empty($searchResult)): ?>
            <h2 class="mb-3">Search Results for "<?php echo htmlspecialchars($_GET['ingredient']); ?>"</h2>
            <div class="row mb-4">
                <?php foreach ($searchResult as $row): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="<?php echo htmlspecialchars($row['titlerecipeimage']); ?>" class="card-img-top card-img-hover" width="200px" height="300px">
                            <div class="card-img-overlay text-white">
                                <h5 class="display-6"><?php echo htmlspecialchars($row['recipetitle']); ?></h5>
                                <p class="lead"><?php echo htmlspecialchars($row['recipedescription']); ?></p>
                                <h6 class="card-footer"><?php echo htmlspecialchars($row['keyrecipeingredients']); ?></h6>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <h2 class="mb-3">Search Results</h2>
            <p>No recipes found for "<?php echo htmlspecialchars($_GET['ingredient']); ?>"</p>
        <?php endif; ?>
    </div>
    <script>
        //Redirection to Home Page on Reload
        if (performance.navigation.type === 1 || performance.getEntriesByType("navigation")[0]?.type === "reload") {
            window.location.href = "index.php";
        }
    </script>
<?php else: ?>
    <!-- Home Page Content -->
    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="Images/Banner1.png" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="Images/Banner2.png" class="d-block w-100">
            </div>
            <div class="carousel-item">
                <img src="Images/Banner3.png" class="d-block w-100">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container mt-4">
        <h2 class="mb-3">Recipes</h2>
        <h3 class="mb-3">Main Course</h3>
        <div class="row mb-4">
            <?php
            if ($mainCourseResult->num_rows > 0) {
                while ($row = $mainCourseResult->fetch_assoc()) {
                    $title = htmlspecialchars($row['recipetitle']);
                    $image = htmlspecialchars($row['titlerecipeimage']);
                    $description = htmlspecialchars($row['recipedescription']);
                    $ingredients = htmlspecialchars($row['keyrecipeingredients']);
                    $ingredientList = implode(", ", array_slice(explode(" ", $ingredients), 0, 4));
                    echo "
                    <div class='col-md-4 mb-4'>
                        <div class='card'>
                        <a href='main_course.php'>
                            <img src='$image' class='card-img-top card-img-hover' width='200px' height='300px'>
                            <div class='card-img-overlay text-white'>
                                <h5 class='display-6'>$title</h5>
                                <p class='lead'>$description</p>
                                <h6 class='card-footer'>$ingredientList</h6>
                            </div>
                            </a>
                        </div>
                    </div>";
                }
            } else {
                echo "<p>No main course recipes found.</p>";
            }
            ?>
        </div>
        <h3 class="mb-3">Desserts</h3>
        <div class="row mb-4">
            <?php
            if ($dessertResult->num_rows > 0) {
                while ($row = $dessertResult->fetch_assoc()) {
                    $title = htmlspecialchars($row['recipetitle']);
                    $image = htmlspecialchars($row['titlerecipeimage']);
                    $description = htmlspecialchars($row['recipedescription']);
                    $ingredients = htmlspecialchars($row['keyrecipeingredients']);
                    $ingredientList = implode(", ", array_slice(explode(" ", $ingredients), 0, 4));
                    echo "
                    <div class='col-md-4 mb-4' id='$id'>
                        <div class='card'>
                        <a href='dessert.php'>
                            <img src='$image' class='card-img-top card-img-hover' width='200px' height='300px'>
                            <div class='card-img-overlay text-white'>
                                <h5 class='display-6'>$title</h5>
                                <p class='lead'>$description</p>
                                <h6 class='card-footer'>$ingredientList</h6>
                            </div>
                            </a>
                        </div>
                    </div>";
                }
            } else {
                echo "<p>No dessert recipes found.</p>";
            }
            ?>
        </div>
    </div>
<?php endif; ?>

<!-- Footer -->
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
    document.addEventListener("DOMContentLoaded",function()
     {

    if(window.location.href.indexOf("action=signup")>0)
     {
        var toastEl = document.getElementById('liveToast');
        document.getElementById('toast-title').innerText="Sign Up";
        document.getElementById('toast-body').innerText="Sign Up Successful!";
          var toast = new bootstrap.Toast(toastEl);
          toast.show();

         
      const urlWithoutQuery = window.location.origin + window.location.pathname;
      window.history.replaceState({}, document.title, urlWithoutQuery);
     }
     if(window.location.href.indexOf("action=logout")>0)
     {
        var toastEl = document.getElementById('liveToast');
        document.getElementById('toast-title').innerText="Logged out";
        document.getElementById('toast-body').innerText="Logout Successful!";
          var toast = new bootstrap.Toast(toastEl);
          toast.show();

         
      const urlWithoutQuery = window.location.origin + window.location.pathname;
      window.history.replaceState({}, document.title, urlWithoutQuery);
     }
     if(window.location.href.indexOf("action=login")>0)
     {
        var toastEl = document.getElementById('liveToast');
        document.getElementById('toast-title').innerText="Logged in";
        document.getElementById('toast-body').innerText="Login Successful!";
          var toast = new bootstrap.Toast(toastEl);
          toast.show();

         
      const urlWithoutQuery = window.location.origin + window.location.pathname;
      window.history.replaceState({}, document.title, urlWithoutQuery);
     }
     
     });
     

</script>    
</body>
</html>

<?php
$connection->close();
?>
