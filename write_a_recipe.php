<?php
// Session Start
session_start();
if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit;
}
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="images/icon" href="Images\Dish Discoveries Logo.png">
    <title>Dish Discoveries - Write a Recipe</title>
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
              <a class="nav-link active" href="write_a_recipe.php">Write a Recipe</a>
            </li>
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
          </ul>
        </div>
        <a href="logout.php" class="btn ms-3" style="background-color: #ff914d; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
          Logout
        </a>
      </div>
    </nav>

    <!-- Write a Recipe Form -->
    <div class="container mt-4 mb-3">
      <h2 class="mb-3">Write a Recipe</h2>
      <form action="recipe_posting.php" method="POST" enctype="multipart/form-data" id="recipeForm" onsubmit="submitForm(event)">
        <div class="mb-3">
          <label class="form-label fw-bold fs-4" for="recipetitle">Recipe Title</label>
          <input class="form-control" type="text" placeholder="Write the recipe title" name="recipetitle" id="recipetitle">
          <div id="titleError" class="error-message"></div>
        </div>
        <div class="mb-3">
          <label class="form-label fw-bold fs-4" for="recipecategory">Recipe Category</label>
          <select class="form-control" name="recipecategory" id="recipecategory">
            <option value="maincourse">Main Course</option>
            <option value="dessert">Dessert</option>
          </select>
          <div id="categoryError" class="error-message"></div>
        </div>
        <div class="mb-3">
          <label class="form-label fw-bold fs-4" for="titlerecipeimage">Recipe Title Card Image</label><br>
          <input type="file" name="titlerecipeimage" accept="image/*" id="titlerecipeimage">
          <div id="titleImageError" class="error-message"></div>
        </div>
        <div class="mb-3">
          <label class="form-label fw-bold fs-4" for="recipeimage">Recipe Image</label><br>
          <input type="file" name="recipeimage" accept="image/*" id="recipeimage">
          <div id="recipeImageError" class="error-message"></div>
        </div>
        <div class="mb-3">
          <label class="form-label fw-bold fs-4" for="recipedescription">Recipe Description</label>
          <textarea class="form-control" name="recipedescription" id="recipedescription"></textarea>
          <div id="descriptionError" class="error-message"></div>
        </div>
        <div class="mb-3">
          <label class="form-label fw-bold fs-4" for="keyrecipeingredients">Key Recipe Ingredients</label>
          <textarea class="form-control" name="keyrecipeingredients" id="keyrecipeingredients"></textarea>
          <div id="keyIngredientsError" class="error-message"></div>
        </div>
        <div class="mb-3">
          <label class="form-label fw-bold fs-4" for="recipeingredients">Recipe Ingredients</label>
          <textarea class="form-control" name="recipeingredients" id="recipeingredients" ></textarea>
          <div id="ingredientsError" class="error-message"></div>
        </div>
        <div class="mb-3">
          <label class="form-label fw-bold fs-4" for="recipeinstructions">Recipe Instructions</label>
          <textarea class="form-control" name="recipeinstructions" id="recipeinstructions" ></textarea>
          <div id="instructionsError" class="error-message"></div>
        </div>

        <!-- Toast Notification -->
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
          <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header" style="background-color: rgb(151, 238, 151)">
              <i class="bi bi-check2-circle fs-3 me-2" style="color: green"></i>
              <strong class="me-auto fs-5 fw-lightbold">Submitted!</strong>
              <small class="muted">Just now</small>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
              Your recipe was submitted successfully!
            </div>
          </div>
        </div>

        <button class="btn btn-warning hover-highlight" type="submit" style="background-color: #ff914d;"">Submit</button>
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

        // Clear previous error messages
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
          //API call for Toast Notification
          var toast = new bootstrap.Toast(toastEl);
          toast.show();

          setTimeout(function () {
            document.getElementById('recipeForm').submit();  
          }, 3000);
        }
      }
    </script>
  </body>
</html>
