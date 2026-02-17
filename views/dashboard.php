<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

    <h1>
        Welcome.
    </h1>

    <a href="/achievement-tracker/public/logout.php">Logout</a>

    <div class="container"> 
        <h2>Your Achievements</h2>
        <a href="/achievement-tracker/public/add_achievement.php">Add New Achievement</a>
        <table>
            <tr>
                <th>Achievement Type</th>
                <th>Achievement Name</th>
                <th>Description</th>
                <th>Date Earned</th>
                <th>Actions</th>
            </tr>

            <tr>
                <td>Grades</td>
                <td>GCSE</td>
                <td>Achieved a GPA of 3.5 or higher for the semester.</td>
                <td>2024-05-15</td>
                <td><a href="/achievement-tracker/public/edit_achievement.php">Edit</a> | <a href="/achievement-tracker/public/delete_achievement.php?id=1">Delete</a></td>
        </table>
    </div>

</body>
</html>
