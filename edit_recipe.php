<?php
// Session Start
session_start();
$serverName = "localhost";
$userName = "root";
$password = "";
$db_name = "db_dishdiscoveries";

// Database connection
$connection = new mysqli($serverName, $userName, $password, $db_name);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit;
}
$recipe=[];
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $userid = $_SESSION['UserID'];

    // Fetch recipe details to prefill the form
    $stmt = $connection->prepare("SELECT * FROM tbl_recipesharing WHERE id = ? AND userid = ?");
    $stmt->bind_param("ii", $id, $userid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $recipe = $result->fetch_assoc();
    } else {
        echo "Unauthorized access or recipe not found.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];
    $userid = $_SESSION['UserID'];

    $recipetitle = $_POST['recipetitle'];
    $recipecategory = $_POST['recipecategory'];
    $recipedescription = $_POST['recipedescription'];
    $keyrecipeingredients = $_POST['keyrecipeingredients'];
    $recipeingredients = $_POST['recipeingredients'];
    $recipeinstructions = $_POST['recipeinstructions'];

    // Update Recipe Statement
    $stmt = $connection->prepare("UPDATE tbl_recipesharing SET recipetitle = ?, recipecategory = ?, recipedescription = ?, keyrecipeingredients = ?, recipeingredients = ?, recipeinstructions = ? WHERE id = ? AND userid = ?");
    $stmt->bind_param("ssssssii", $recipetitle, $recipecategory, $recipedescription, $keyrecipeingredients, $recipeingredients, $recipeinstructions, $id, $userid);

    if ($stmt->execute()) {
        // Redirection after updation
        header("Location: yourrecipe.php"); 
        exit;
    } else {
        echo "Error updating recipe.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="Images/Dish Discoveries Logo.png">
    <title>Dish Discoveries - Edit Recipe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
      .card-img-overlay {
        transition: background-color 0.3s ease;
      }
      .card:hover .card-img-overlay {
        background-color: rgba(0, 0, 0, 0.7); 
      }

      .error-message {
        color: red;
        font-size: 0.875rem;
      }
      .hover-highlight:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transform: scale(1.05); 
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
            <li class="nav-item">
              <a class="nav-link" href="write_a_recipe.php">Write a Recipe</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="edit_recipe.php">Edit Recipe</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Recipes
              </a>
              <?php 
                if(isset($_SESSION["UserID"]))
                {
                echo '<li class="nav-item">
                    <a class="nav-link" href="yourrecipe.php">Your Recipes</a>
                </li>';
                }
                ?>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="main_course.php">Main Course</a></li>
                <li><a class="dropdown-item" href="dessert.php">Dessert</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about_us.php">About Us</a>
            </li>
          </ul>
        </div>
        <a href="logout.php" class="btn ms-3" style="background-color: #ff914d; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
          Logout
        </a>
      </div>
    </nav>

    <div class="container mt-4 mb-3">
  <h2 class="mb-3">Edit Recipe</h2>
  <form action="edit_recipe.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $recipe['id']; ?>">

    <div class="mb-3">
      <label class="form-label fw-bold fs-4" for="recipetitle">Recipe Title</label>
      <input class="form-control" type="text" name="recipetitle" id="recipetitle" value="<?php echo isset($recipe['recipetitle']) ? htmlspecialchars($recipe['recipetitle']) : ''; ?>">
    </div>

    <div class="mb-3">
      <label class="form-label fw-bold fs-4" for="recipecategory">Recipe Category</label>
      <select class="form-control" name="recipecategory" id="recipecategory">
       <option value="maincourse" <?php echo (isset($recipe['recipecategory']) && $recipe['recipecategory'] === 'maincourse') ? 'selected' : ''; ?>>Main Course</option>
        <option value="dessert" <?php echo (isset($recipe['recipecategory']) && $recipe['recipecategory'] === 'dessert') ? 'selected' : ''; ?>>Dessert</option>
      </select>
    </div>

   <div class="mb-3">
    <label class="form-label fw-bold fs-4" for="recipedescription">Recipe Description</label>
    <textarea class="form-control" name="recipedescription" id="recipedescription"><?php echo isset($recipe['recipedescription']) ? htmlspecialchars($recipe['recipedescription']) : ''; ?></textarea>
  </div>

  <div class="mb-3">
    <label class="form-label fw-bold fs-4" for="keyrecipeingredients">Key Recipe Ingredients</label>
    <textarea class="form-control" name="keyrecipeingredients" id="keyrecipeingredients"><?php echo isset($recipe['keyrecipeingredients']) ? htmlspecialchars($recipe['keyrecipeingredients']) : ''; ?></textarea>
  </div>

  <div class="mb-3">
    <label class="form-label fw-bold fs-4" for="recipeingredients">Recipe Ingredients</label>
    <textarea class="form-control" name="recipeingredients" id="recipeingredients" ><?php echo isset($recipe['recipeingredients']) ? htmlspecialchars($recipe['recipeingredients']) : ''; ?></textarea>
  </div>

  <div class="mb-3">
    <label class="form-label fw-bold fs-4" for="recipeinstructions">Recipe Instructions</label>
    <textarea class="form-control" name="recipeinstructions" id="recipeinstructions" ><?php echo isset($recipe['recipeinstructions']) ? htmlspecialchars($recipe['recipeinstructions']) : ''; ?></textarea>
  </div>

    <button class="btn btn-warning hover-highlight" type="submit" style="background-color: #ff914d;">Update Recipe</button>
  </form>
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

    <script>
      function submitForm(event) {
        event.preventDefault();

        document.querySelectorAll('.error-message').forEach(function (error) {
          error.innerHTML = '';
        });

        let isValid = true;

        // Check Recipe Title
        const title = document.getElementById('recipetitle').value.trim();
        if (!title) {
          document.getElementById('titleError').innerText = "Recipe Title is required.";
          isValid = false;
        }

        // Check Recipe Category
        const category = document.getElementById('recipecategory').value;
        if (!category) {
          document.getElementById('categoryError').innerText = "Recipe Category is required.";
          isValid = false;
        }

        // Check Title Image
        const image1 = document.getElementById('titlerecipeimage').value;
        if (!image1) {
          document.getElementById('titleImageError').innerText = "Recipe Title Card Image is required.";
          isValid = false;
        }

        // Check Recipe Image
        const image2 = document.getElementById('recipeimage').value;
        if (!image2) {
          document.getElementById('recipeImageError').innerText = "Recipe Image is required.";
          isValid = false;
        }

        // Check Description
        const description = document.getElementById('recipedescription').value.trim();
        if (!description) {
          document.getElementById('descriptionError').innerText = "Recipe Description is required.";
          isValid = false;
        }

        // Check Key Ingredients
        const keyIngredients = document.getElementById('keyrecipeingredients').value.trim();
        if (!keyIngredients) {
          document.getElementById('keyIngredientsError').innerText = "Key Recipe Ingredients are required.";
          isValid = false;
        }

        // Check Ingredients
        const ingredients = document.getElementById('recipeingredients').value.trim();
        if (!ingredients) {
          document.getElementById('ingredientsError').innerText = "Recipe Ingredients are required.";
          isValid = false;
        }

        // Check Instructions
        const instructions = document.getElementById('recipeinstructions').value.trim();
        if (!instructions) {
          document.getElementById('instructionsError').innerText = "Recipe Instructions are required.";
          isValid = false;
        }

        if (isValid) {
          var toastEl = document.getElementById('liveToast');
          var toast = new bootstrap.Toast(toastEl);
          toast.show();

          setTimeout(function () {
            document.getElementById('recipeForm').submit();  
          }, 5000);
        }
      }
    </script>
  </body>
</html>
