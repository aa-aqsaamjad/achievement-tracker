<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Achievement</title>

    <link rel="stylesheet" href="/achievement-tracker/public/css/main.css">
    <link rel="stylesheet" href="/achievement-tracker/public/css/add_achievement.css">
</head>

<body>
    <h1> Add New Achievement</h1>
    <div class="container">
        <form method="POST" action="/achievement-tracker/public/add_achievement.php">
            <label for="category">Category:</label>
            <select id="category" name="category_id" required>
                <option value="">Select a category</option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['category_id']; ?>">
                        <?php echo htmlspecialchars($category['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>

            <label for="title">Achievement Name:</label>
            <input type="text" id="title" name="title" required><br><br>

            <label for="description">Description:</label><br>
            <textarea id="description" name="description" rows="4" cols="50"></textarea><br><br>

            <label for="date_received">Date Earned:</label>
            <input type="date" id="date_received" name="date_received" required><br><br>

            <button type="submit" class="btn">Add Achievement</button>
        </form>
    </div>

</body>
</html>