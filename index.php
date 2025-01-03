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
            <li><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#footer">Contact</a></li>
            <li><a href="adminlogin.html">Admin</a></li>
            <li><a href="signup.php">Sign Up</a></li>
          </ul>
        </nav>
      </div>
    </header>
    <main>
      <div class="banner">
        <div class="banner-block">
          </div>
      </div>
      <div class="articles" id="about">
        <div class="wrapper">
          <article>
            <h2>Anupam Foodland and Banquet</h2>
            <p class="quote">Welcome to Anupam Foodland and Banquet</p>
            <p class="text">
              Located in the vibrant heart of Nepal, Anupam Foodland and Banquet
              stands as a beacon of culinary excellence and unparalleled event
              experiences. Since our inception, we have been committed to
              redefining hospitality with a seamless blend of exquisite
              cuisines, warm ambiance, and meticulous service. Whether it's a
              cherished family gathering, an elegant wedding, or a corporate
              milestone, we take pride in being the preferred choice for
              unforgettable celebrations. With a passion for perfection and a
              dedication to creating memories, we invite you to experience the
              finest in dining and event planning at Anupam Foodland and
              Banquet.
            </p>
            <p class="text">
              Anupam Foodland has successfully hosted over 100s of anniversary
              events with 5 star customer satisfaction. As an ISO 22000:2018
              food management and safety standards banquets, we maintain highest
              of standards ensuring your wedding events are truly memorable and
              mesmerizing.
            </p>
          </article>
          <article>
            <h2>Our Venues</h2>
            <div class="carousel-container">
              <div class="carousel" id="carousel">
                <div class="carousel-slide">
                  <div class="card">
                    <img
                      src="Images/hall1.jpg"
                      alt="Card image"
                      class="card-image"
                    />
                    <div class="card-content">
                      <h3 class="card-title">Akshyapatra Hall</h3>
                      <h4 class="card-subtitle">Capacity - 1000pax +</h4>
                      <p class="card-description">
                        Designed from grandeur events. A newly renovated venue
                        with the hosting capacity of 900+ at a time . Suitable
                        for weddings, receptions, corporate events and many
                        more.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="carousel-slide">
                  <div class="card">
                    <img
                      src="Images/hall2.jpg"
                      alt="Card image"
                      class="card-image"
                    />
                    <div class="card-content">
                      <h3 class="card-title">Kalpavrikshya Hall</h3>
                      <h4 class="card-subtitle">Capacity - 500pax +</h4>
                      <p class="card-description">
                        Elegantly designed venue for mid scale events with the
                        hosting capacity of 550+ Suitable for weddings,
                        receptions, anniversaries, corporate events, birthdays
                        and many more.
                      </p>
                    </div>
                  </div>
                </div>
                <div class="carousel-slide">
                  <div class="card">
                    <img
                      src="Images/hall3.jpg"
                      alt="Card image"
                      class="card-image"
                    />
                    <div class="card-content">
                      <h3 class="card-title">Garden Hall</h3>
                      <h4 class="card-subtitle">Capacity - 300pax +</h4>
                      <p class="card-description">
                        Elegantly designed venue for small scale or closed
                        knitted gatherings with the venue capacity of 350+.
                        Suitable for engagements, receptions, anniversaries,
                        birthdays and many more.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <button
                class="carousel-button carousel-button-prev"
                onclick="document.getElementById('carousel').scrollBy(-300, 0)"
              >
                &#10094;
              </button>
              <button
                class="carousel-button carousel-button-next"
                onclick="document.getElementById('carousel').scrollBy(300, 0)"
              >
                &#10095;
              </button>
            </div>
          </article>
        </div>
      </div>
    </main>
     <?php require 'css/assets/footer.html'; ?> 
</body>
</html>
   
      