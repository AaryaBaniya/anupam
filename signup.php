<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Anupam</title>
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <header class="page-header">
      <div class="wrapper">
        <div class="logo">
          <a href="index.html">
            <img class="img" src="Images/logo.png" alt="logo" />
          </a>
        </div>
        <nav class="main-nav">
          <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="signup.php">Sign Up</a></li>
          </ul>
        </nav>
      </div>
    </header>
    <div class="box">
      <div class="signup-container">
        <h1>Create an Account</h1>
        <form method="post" action="signin.php">
          <div class="form-group">
            <label for="fullname">Full Name</label>
            <input type="text" id="fullname" name="fullname" required />
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required />
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input
              type="password"
              id="password"
              name="password"
              required
              minlength="8"
            />
            <p class="password-hint">
              Password must be at least 8 characters long
            </p>
          </div>
          <button type="submit">Sign Up</button>
        </form>
        <div class="login-link">
          Already have an account?
          <a
            href="signin.php"
            >Log in</a
          >
        </div>
      </div>
    </div>
    <?php require 'css/assets/footer.html'; ?> 
  </body>
</html>
