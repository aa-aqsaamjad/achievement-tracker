<?php if (!empty($error)): ?>
    <p style="color: red;"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In / Sign Up</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <link rel="stylesheet" href="../public/css/main.css">
    <link rel="stylesheet" href="../public/css/auth.css">
</head>

<body>

    <h1> Achievement Tracker</h1>

    <div class="container" id="signup">
        <h2 class="form-title">Register</h2>
        <form method="POST" action="/achievement-tracker/public/auth.php"> 
            <div class="input-group">
                <i class="fa-regular fa-user"></i>  
                <input type="text" id="first_name" name="first_name" required><br><br>
            </div>
            <div class="input-group">
                <i class="fa-regular fa-user"></i>
                <input type="text" id="last_name" name="last_name" required><br><br>
            </div>
            <div class="input-group">

                <i class="fa-regular fa-envelope"></i>
                <input type="email" id="email" name="email" required><br><br>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" id="password" name="password" required><br><br>
            </div>
            <button type="submit" class="btn" value="Sign Up" name="signUp">Sign Up</button>
        </form>
        <p> Already have an account?</p>
        <button id="signInButton"> Sign In </button>
    </div>

    <div class="container" id="signin">
        <h1 class="form-title">Sign In</h1>
        <form method="POST" action="/achievement-tracker/public/auth.php"> 
            <div class="input-group">
                <i class="fa-regular fa-envelope"></i>
                <input type="email" id="email" name="email" required><br><br>
            </div>
            <div class="input-group">
                <i class="fa-solid fa-lock"></i>
                <input type="password" id="password" name="password" required><br><br>
            </div>
            <button type="submit" class="btn" value="signIn" name="signIn">Sign In</button>
        </form>

        <p> Don't have an account?</p>
        <button id="signUpButton"> Sign Up </button>
    </div>

    <script src="../public/js/auth.js"></script>
</body>
</html>