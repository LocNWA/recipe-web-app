<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Search</title>
    <!-- Water.css library -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <script src="http://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script src="http://code.jquery.com/ui/1.12.0/jquery-ui.min.js" integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="usingAjax.js"></script>

</head>
<body>
    <label for="ingredients">Enter Ingredients:</label>
    <input type="text" id="ingredients" placeholder="Enter ingredients separated by commas">
    <button onclick="searchRecipes()">Search</button>

    <div id="recipeList">
        <!-- Recipe search results will be displayed here -->
    </div>

    <script>
        function searchRecipes() {
            // Get the ingredients entered by the user
            const ingredientsInput = document.getElementById('ingredients').value.trim();
            const ingredientsArray = ingredientsInput.split(',').map(ingredient => ingredient.trim());

            // Send an AJAX request to the server to fetch recipes based on ingredients
            const xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Parse the response JSON
                        const recipes = JSON.parse(xhr.responseText);

                        // Display the search results
                        displayRecipes(recipes);
                    } else {
                        console.error('Error fetching recipes:', xhr.status);
                    }
                }
            };
            xhr.open('GET', 'search_recipes.php?ingredients=' + ingredientsArray.join(','));
            xhr.send();
        }

        function displayRecipes(recipes) {
            const recipeList = document.getElementById('recipes');
            recipeList.innerHTML = ''; // Clear previous results

            if (recipes.length === 0) {
                recipeList.innerHTML = '<p>No recipes found.</p>';
                return;
            }

            // Loop through each recipe and create HTML elements to display them
            recipes.forEach(recipe => {
                const recipeDiv = document.createElement('div');
                recipeDiv.classList.add('recipe');

                const titleHeading = document.createElement('h2');
                titleHeading.textContent = recipe.title;

                const prepTimeParagraph = document.createElement('p');
                prepTimeParagraph.innerHTML = `<strong>Prep Time:</strong> ${recipe.prep_time} minutes`;

                const cookingTimeParagraph = document.createElement('p');
                cookingTimeParagraph.innerHTML = `<strong>Cooking Time:</strong> ${recipe.cooking_time} minutes`;

                const instructionsParagraph = document.createElement('p');
                instructionsParagraph.innerHTML = `<strong>Instructions:</strong> ${recipe.instructions}`;

                const mediaImage = document.createElement('img');
                mediaImage.src = recipe.media_upload;
                mediaImage.alt = recipe.title;

                const viewDetailsLink = document.createElement('a');
                viewDetailsLink.href = `recipe_details.php?id=${recipe.id}`;
                viewDetailsLink.textContent = 'View Details';

                recipeDiv.appendChild(titleHeading);
                recipeDiv.appendChild(prepTimeParagraph);
                recipeDiv.appendChild(cookingTimeParagraph);
                recipeDiv.appendChild(instructionsParagraph);
                recipeDiv.appendChild(mediaImage);
                recipeDiv.appendChild(viewDetailsLink);

                recipeList.appendChild(recipeDiv);
            });
        }
    </script>
</body>
</html>
