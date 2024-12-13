<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>

  <!-- Header -->
  <header id="header" class="alt">
        <div class="logo">
            <a href="index.php">Cityzens <span></span></a>
        </div>
        <a href="#menu">Menu</a>
    </header>

    <!-- Nav -->
    <nav id="menu">
        <ul class="links">
            <li><a href="index.php">Home</a></li>
            <li><a href="Login.php">Login</a></li>
            <li><a href="elements.php">Elements</a></li>
        </ul>
    </nav>

<!-- Banner Section -->
<section id="banner">
    <div class="inner">
        <header class="align-center">
        </header>
        
        <!-- Main Section Inside Banner -->
        <div id="main" class="wrapper style1">
            <div class="inner">
                <header class="align-center">
                    <h2>Register</h2>
                    <p>Create your account</p>
                </header>
                <div class="content">
                    <form action="process_register.php" method="POST" class="box">
                        <div class="row uniform">
                            <!-- Username Field -->
                            <div class="12u">
                                <label for="username">ID</label>
                                <input type="text" name="username" id="username" placeholder="Choose your username" required>
                            </div>
                            <!-- Password Field -->
                            <div class="12u">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" placeholder="Create a password" required>
                            </div>
                            <!-- Confirm Password Field -->
                            <div class="12u">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password" required>
                            </div>
                            <!-- Actions -->
                            <div class="12u">
                                <ul class="actions">
                                    <li><input type="submit" value="Register" class="button alt"></li>
                                    <li><a href="Login.php" class="button alt">Back to Login</a></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>
