<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Manage Recipes</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <div class="container">
        <h1>Admin Dashboard - Manage Recipes</h1>
        <a href="add_recipe.php">Add New Recipe</a>
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Prep Time</th>
                <th>Cooking Time</th>
                <th>Media</th>
                <th>Actions</th>
            </tr>
            <?php include('list_recipes.php'); ?>
        </table>
    </div>
</body>
</html>
