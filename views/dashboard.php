<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <link rel="stylesheet" href="/achievement-tracker/public/css/main.css">
    <link rel="stylesheet" href="/achievement-tracker/public/css/dashboard.css">
    
</head>
<body>

    <div class="header">
        <h1 class="welcome-message">
            Welcome, <?php echo htmlspecialchars($first_name); ?>
        </h1>
        <a class="logout-link" href="/achievement-tracker/public/logout.php">Logout</a>
    </div>

    <div class="container"> 
        <h2>Your Achievements</h2>
        <a class="btn add" href="/achievement-tracker/public/add_achievement.php">+ New Achievement</a>

        <table class="achievement-table">
            <tr>
                <th>Achievement Type</th>
                <th>Achievement Name</th>
                <th>Description</th>
                <th>Date Earned</th>
                <th>Actions</th>
            </tr>

            <?php if (empty($achievements)): ?>
                <tr>
                    <td colspan="5">No achievements found. Start adding some!</td>
                </tr>
            <?php else: ?>
                <?php foreach ($achievements as $achievement): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($achievement['category_name'] ?? 'Uncategorized'); ?></td>
                        <td><?php echo htmlspecialchars($achievement['title']); ?></td>
                        <td><?php echo htmlspecialchars($achievement['description']); ?></td>
                        <td><?php echo htmlspecialchars($achievement['date_received']); ?></td>
                        <td>
                            <a href="/achievement-tracker/public/edit_achievement.php?id=<?php echo $achievement['achievement_id']; ?>">Edit</a> | 
                            <a href="/achievement-tracker/public/delete_achievement.php?id=<?php echo $achievement['achievement_id']; ?>">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>

</body>
</html>