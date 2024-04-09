<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <title>Recipe Search</title>
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
            const recipeList = document.getElementById('recipeList');
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
                titleHeading.textContent = title;

                const prepTimeParagraph = document.createElement('p');
                prepTimeParagraph.innerHTML = `<strong>Prep Time:</strong> ${prep_time} minutes`;

                const cookingTimeParagraph = document.createElement('p');
                cookingTimeParagraph.innerHTML = `<strong>Cooking Time:</strong> ${cooking_time} minutes`;

                const instructionsParagraph = document.createElement('p');
                instructionsParagraph.innerHTML = `<strong>Instructions:</strong> ${instructions}`;

                const mediaImage = document.createElement('img');
                mediaImage.src = media_upload;
                mediaImage.alt = title;

                const viewDetailsLink = document.createElement('a');
                viewDetailsLink.href = `recipe_details.php?id=${id}`;
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
