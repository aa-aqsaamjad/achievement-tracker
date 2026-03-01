<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Achievement</title>

    <link rel="stylesheet" href="/achievement-tracker/public/css/main.css">
    <link rel="stylesheet" href="/achievement-tracker/public/css/add_achievement.css">
</head>

<body>

    <h1>Edit Achievement</h1>

    <div class="container">

        <?php if (!empty($error)): ?>
            <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>

        <form method="POST" action="/achievement-tracker/public/edit_achievement.php">

            <input type="hidden" name="achievement_id" value="<?php echo $achievement['achievement_id']; ?>">

            <!-- Category -->
            <label for="category">Category:</label>
            <select id="category" name="category_id" required>
                <?php foreach ($categories as $category): ?>
                    <option value="<?php echo $category['category_id']; ?>"
                        <?php if ($category['category_id'] == $achievement['category_id']) echo 'selected'; ?>>
                        <?php echo htmlspecialchars($category['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <!-- Title -->
            <label for="title">Achievement Name:</label>
            <input
                type="text"
                id="title"
                name="title"
                value="<?php echo htmlspecialchars($achievement['title']); ?>"
                required
            >

            <!-- Description -->
            <label for="description">Description:</label>
            <textarea
                id="description"
                name="description"
                rows="4"
            ><?php echo htmlspecialchars($achievement['description']); ?></textarea>

            <!-- Date -->
            <label for="date_received">Date Earned:</label>
            <input
                type="date"
                id="date_received"
                name="date_received"
                value="<?php echo htmlspecialchars($achievement['date_received']); ?>"
                required
            >

            <button type="submit" class="btn">Save Changes</button>

        </form>

        <a href="/achievement-tracker/public/dashboard.php" class="back-link">← Back to dashboard</a>

    </div>

</body>
</html>