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
            <li><a href="book.html">Book Now</a></li>
            <li><a href="signup.html">Sign Up</a></li>
          </ul>
        </nav>
      </div>
    </header>
    <div class="box">
      <div class="signin-container">
        <h1>Sign In</h1>
        <form method="post" action="register.php">
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
          <button type="submit">Sign In</button>
        </form>
        <div class="login-link">
          Dont have an account?
          <a
            href="signup.php"
            >Sign Up</a
          >
        </div>
      </div>
    </div>
    <footer class="page-footer" id="footer">
      <div class="wrapper">
        <div style="display: flex; justify-content: space-between">
          <div class="footer-col" style="margin-bottom: 24px">
            <h3>Contact Us</h3>
            <ul>
              <li>Phone: 9828884062</li>
              <li>Email: anupamfoodland@gmail.com</li>
              <li>Old Baneshwor, Kathmandu</li>
            </ul>
          </div>

          <div class="footer-col social">
            <h3>Social</h3>
            <ul>
              <li>
                <a href="#" class="fb"><i class="fab fa-facebook"></i></a>
              </li>
              <li>
                <a href="#" class="tw"><i class="fab fa-twitter"></i></a>
              </li>
              <li>
                <a href="#" class="gp"><i class="fab fa-google"></i></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </body>
</html>
