<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stammerapy</title>

  <!-- 
    - favicon
  -->
  <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

  <!-- 
    - custom css link
  -->
  <link rel="stylesheet" href="./assetss/css/style.css">

  <!-- 
    - google font link
  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&family=Source+Sans+Pro:wght@600;700&display=swap"
    rel="stylesheet">



<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');

.hero-title {
  color: var(--white);
  font-size: 4rem;
  margin-block-end: 20px;
}

.why-us .content {
            padding: 60px 100px 0 100px;
        }
        .why-us .content h3 {
            font-weight: 400;
            font-size: 34px;
            color: black;
        }
        .why-us .content h4 {
            font-size: 20px;
            font-weight: 700;
            margin-top: 5px;
        }
        .why-us .content p {
            font-size: 15px;
            color: #848484;
        }
        .why-us .img {
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center center;
        }
        .why-us .accordion-list {
            padding: 0 100px 60px 100px;
        }
        .why-us .accordion-list ul {
            padding: 0;
            list-style: none;
        }
        .why-us .accordion-list li + li {
            margin-top: 15px;
        }
        .why-us .accordion-list li {
            padding: 20px;
            border-radius: 4px;
        }
        .why-us .accordion-list a {
            display: block;
            position: relative;
            font-family: "Poppins", sans-serif;
            font-size: 16px;
            line-height: 24px;
            font-weight: 500;
            padding-right: 30px;
            outline: none;
            cursor: pointer;
        }
        .why-us .accordion-list span {
            color: #47b2e4;
            font-weight: 600;
            font-size: 18px;
            padding-right: 10px;
        }
        .why-us .accordion-list i {
            font-size: 24px;
            position: absolute;
            right: 0;
            top: 0;
        }
        .why-us .accordion-list p {
            margin-bottom: 0;
            padding: 10px 0 0 0;
        }
        .why-us .accordion-list .icon-show {
            display: none;
        }
        .why-us .accordion-list a.collapsed {
            color: #343a40;
        }
        .why-us .accordion-list a.collapsed:hover {
            color: #47b2e4;
        }
        .why-us .accordion-list a.collapsed .icon-show {
            display: inline-block;
        }
        .why-us .accordion-list a.collapsed .icon-close {
            display: none;
        }
@media (max-width: 1024px) {
  .why-us .content, .why-us .accordion-list {
    padding-left: 0;
    padding-right: 0;
  }
}
@media (max-width: 992px) {
  .why-us .img {
    min-height: 400px;
  }
  .why-us .content {
    padding-top: 30px;
  }
  .why-us .accordion-list {
    padding-bottom: 30px;
  }
}
@media (max-width: 575px) {
  .why-us .img {
    min-height: 200px;
  }
}

body {
  font-family: 'Poppins', sans-serif;
  color: #444444;
}

a {
  color: #47b2e4;
  text-decoration: none;
}

a:hover {
  color: #73c5eb;
  text-decoration: none;
}

h1, h2, h3, h4, h5, h6 {
  font-family: 'Poppins', sans-serif;
};

/* Dropdown container */
.dropdown {
    position: relative;
    display: inline-block;
}

/* User icon */
.user-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
}

/* Dropdown button (user icon button) */
.dropbtn {
    background-color: transparent;
    border: none;
    cursor: pointer;
    padding: 0;
}

/* Dropdown content (hidden by default) */
.dropdown-content {
    display: none;
    position: absolute;
    background-color: #ffffff; /* Use white for better contrast */
    min-width: 180px; /* Adjust width for better readability */
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2); /* Add a subtle shadow */
    z-index: 1;
    right: 50px; /* Align the dropdown to the right edge */
    margin-top: 10px; /* Add spacing below the icon */
    border-radius: 8px; /* Round the corners for a modern look */
    overflow: hidden; /* Prevent overflow issues */
}

/* Links inside the dropdown */
.dropdown-content a {
    color: #333; /* Use dark gray for text */
    padding: 10px 16px; /* Adjust padding for better spacing */
    text-decoration: none;
    display: block;
    font-size: 14px; /* Make the text size consistent */
    font-family: Arial, sans-serif; /* Use a clean font */
    text-align: left;
    transition: background-color 0.3s ease; /* Smooth hover effect */
}

/* Change the color of links on hover */
.dropdown-content a:hover {
    background-color: #f0f0f0; /* Subtle highlight on hover */
    color: #000; /* Use black for hover text color */
}

/* Show dropdown on hover */
.dropdown:hover .dropdown-content {
    display: block;
}


.logo-container {
            display: inline-block;
            padding: 3px;
            width: 70px;
            height: 70px;
        }
        .logo-container img {
            max-width: 100%;
            height: 100%;
            display: block;
        }
</style>


  </head>

<body id="top">

  <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">

      <div class="overlay" data-overlay></div>

      <div class="logo-container">
      <img src="./assetss/images/Stammerapy-logo.jpg">
      </div>
        <h1 class="logo">Stammerapy</h1>

      <nav class="navbar" data-navbar>

        <div class="navbar-top">
          <a href="#" class="logo">Stammerapy</a>
        </div>

        <ul class="navbar-list">

          <li class="navbar-item">
            <a href="homiee.php" class="navbar-link" data-navbar-link>Home</a>
          </li>

          <li class="navbar-item">
            <a href="aboutus.php" class="navbar-link" data-navbar-link>About Us</a>
          </li>

          <li class="navbar-item">
            <a href="stutterAnalysis.php" class="navbar-link" data-navbar-link>Stutter Analysis</a>
          </li>

          <li class="navbar-item">
            <a href="plans.php" class="navbar-link" data-navbar-link>Plans</a>
          </li>

          <li class="navbar-item">
            <a href="exercises.php" class="navbar-link" data-navbar-link>Exercises</a>
          </li>

          <li class="navbar-item">
            <a href="therapist.php" class="navbar-link" data-navbar-link>Therapist</a>
          </li>

          <li class="navbar-item">
            <a href="contact_us.php" class="navbar-link" data-navbar-link>Contact Us</a>
          </li>

          <div class="dropdown">
        <button id="dropbtn" class="dropbtn">
            <img src="./images/profile.png" alt="User Icon" class="user-icon">
        </button>
        <div id="dropdown-content" class="dropdown-content">
            <a href="profile.php">View Profile</a>
            <a href="components/user_logout.php" onclick="return confirm('logout from this website?');">Logout</a>

            
        </div>
    </div>

        </ul>

      </nav>

    </div>
  </header>





  <main>
    <article>

      <!-- 
        - #HERO
      -->

      <section class="hero">
        <div class="container">

          <div class="hero-content" id="home">

            <p class="hero-subtitle">Empowering You to Speak with Ease.</p>

            <h2 class="h2 hero-title">Speech Therapy is the key to a Fulfilling Lifestyle</h2></span>

            <p class="hero-text">
              Therapy can be a valuable tool for many people in navigating <br />
              life's challenges and improving mental well-being. While it's not <br />
              necessarily the only key to a fulfilling life, it can unlock doors <br />
              to understanding oneself better, managing emotions, and <br />
              developing healthier coping mechanisms. Therapy offers a <br />
              safe space to explore thoughts, feelings, and experiences.
            </p>

          </div>

          <figure class="hero-banner">
            <img src="./assetss/images/stam.png" width="694" height="529" loading="lazy" alt="hero-banner"
              class="w-100 banner-animation">
          </figure>

        </div>
      </section>





<!-- 
        - #ABOUT
      -->

      <section class="section about" id="benefits">
        <div class="container">

          <figure class="about-banner">
            <img src="./assetss/images/virtual-therapy.jpg" width="700" height="532" loading="lazy" alt="about banner"
              class="w-100 banner-animation">
          </figure>

          <div class="about-content">

            <h2 class="h2 section-title underline">Benefits Of Therapy</h2>

            <p class="about-text">
              Speech therapy improves communication skills, aiding in clearer articulation, language development, and fluency.
It helps individuals overcome speech disorders such as stuttering, lisps, and voice disorders, enhancing their
confidence and social interactions. Through personalized intervention and exercises, speech therapy enables
individuals to express themselves effectively and participate fully in daily activities.
            </p>

            

            <ul class="stats-list">

              <li class="stats-card">
                <h4 class="stats-text">Improved Communication Skills</h4>
              </li>


              <li class="stats-card">
                <h4 class="stats-text">Treatment for Speech Disorders</h4>
              </li>

              <li class="stats-card">
                <h4 class="stats-text">Enhanced Social Interaction</h4>
              </li>
            </ul>

          </div>

        </div>
      </section>

      <!-- 
        - #FEATURES
      -->

      <section class="section features" id="features">
        <div class="container">

          <h2 class="h2 section-title underline">Our Features</h2>

          <ul class="features-list">

            <li>
              <div class="features-card">

                <div class="icon">
                  <ion-icon name="mic-outline"></ion-icon>
              </div>
              

                <div class="content">
                  <h3 class="h3 title">Voice Recognition</h3>

                  <p class="text">Voice recognition provides instant feedback to enhance speech fluency.</p>
                </div>

              </div>
            </li>

            <li>
              <div class="features-card">

                <div class="icon">
                  <ion-icon name="people-circle-outline"></ion-icon>
                </div>

                <div class="content">
                  <h3 class="h3 title">Community Support</h3>

                  <p class="text">The community support feature connects users with peers and professionals for shared experiences, encouragement, and advice.</p>
                </div>

              </div>
            </li>

          </ul>

          <figure class="features-banner">
            <img src="./assetss/images/stuttering.png" width="369" height="318" loading="lazy" alt="Features Banner"
              class="w-100 banner-animation">
          </figure>

          <ul class="features-list">

            <li>
              <div class="features-card">

                <div class="icon">
                  <ion-icon name="medkit-outline"></ion-icon>
                </div>
                

                <div class="content">
                  <h3 class="h3 title">Therapist</h3>

                  <p class="text">Connect with specialized therapists for personalized stammering support and guidance.</p>
                </div>

              </div>
            </li>

            <li>
              <div class="features-card">

                <div class="icon">
                  <ion-icon name="videocam-outline"></ion-icon>
                </div>
                

                <div class="content">
                  <h3 class="h3 title">Educational Resources</h3>

                  <p class="text">Access a wealth of educational resources, including video tutorials and articles, to better understand and manage stammering effectively.</p>
                </div>

              </div>
            </li>

          </ul>

        </div>
      </section>





      
    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container-fluid" data-aos="fade-up" id="faqs">

          <div class="row">

              <div class="col-lg-7 d-flex flex-column justify-content-center align-items-stretch order-2 order-lg-1">

                  <div class="content">
                    <h2 class="h2 section-title underline">Frequently Asked Questions</h2>
                      <p>
                      Choose us for a supportive and understanding community, where your progress matters. We're here to help you build confidence and improve your speech at your own pace.
                      </p>
                  </div>

                  <div class="accordion-list">
                      <ul>
                          <li>
                              <a data-bs-toggle="collapse" class="collapse show" data-bs-target="#accordion-list-1"><span>01</span> Who can use this app? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                              <div id="accordion-list-1" class="collapse show" data-bs-parent=".accordion-list">
                                  <p>
                                  Anyone who stammers, regardless of age or experience, can use this app to work on their speech at their own pace.
                                  </p>
                              </div>
                          </li>

                          <li>
                              <a data-bs-toggle="collapse" data-bs-target="#accordion-list-2" class="collapsed"><span>02</span> Can I use this app without a therapist? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                              <div id="accordion-list-2" class="collapse" data-bs-parent=".accordion-list">
                                  <p>
                                  Yes, you can use the app on your own, but you can also connect with a therapist if you want more personalized guidance.                                    </p>
                              </div>
                          </li>

                          <li>
                              <a data-bs-toggle="collapse" data-bs-target="#accordion-list-3" class="collapsed"><span>03</span> Is there a community or support group within the app? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                              <div id="accordion-list-3" class="collapse" data-bs-parent=".accordion-list">
                                  <p>
                                  Yes, the app includes a community forum where you can share experiences, ask questions, and get support from others.                                    </p>
                              </div>
                          </li>
                      </ul>
                  </div>

              </div>

              <div class="col-lg-5 align-items-stretch order-1 order-lg-2 img" style='background-image: url("images/therapist.jpeg");' data-aos="zoom-in" data-aos-delay="150">&nbsp;</div>
          </div>

      </div>
  </section><!-- End Why Us Section -->


    </article>
  </main>





  <!-- 
    - #FOOTER
  -->

  <footer class="footer">

    <div class="footer-top section">
      <div class="container">

        <div class="footer-brand">

          <a href="#" class="logo">Stammerapy</a>

          <p class="text">
            Stammerapy is a comprehensive web app designed to support individuals with stammering, offering personalized therapy plans, real-time speech analysis, and community engagement to improve speech fluency and confidence.
          </p>

          <ul class="social-list">

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-facebook"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-instagram"></ion-icon>
              </a>
            </li>

            <li>
              <a href="#" class="social-link">
                <ion-icon name="logo-twitter"></ion-icon>
              </a>
            </li>

          </ul>

        </div>

      </br>

        <ul class="footer-list" style="float: right">

          <li>
            <p class="footer-list-title">Our links</p>
          </li>

          <li>
            <a href="homiee.php" class="footer-link">Home</a>
          </li>

          <li>
            <a href="aboutus.php" class="footer-link">About Us</a>
          </li>

          <li>
            <a href="stutterAnalysis.php" class="footer-link">Stutter Analysis</a>
          </li>

          <li>
            <a href="plans.php" class="footer-link">Plans</a>
          </li>

          <li>
            <a href="exercises.php" class="footer-link">Exercises</a>
          </li>

          <li>
            <a href="therapist.php" class="footer-link">Therapist</a>
          </li>

          <li>
            <a href="contact_us.php" class="footer-link">Contact Us</a>
          </li>


        </ul>
        </br>

        <ul class="footer-list">

          <li>
            <p class="footer-list-title">Contact Us</p>
          </li>

          <li class="footer-item">

            <div class="footer-item-icon">
              <ion-icon name="call"></ion-icon>
            </div>

            <div>
              <a href="tel:+2484214313" class="footer-item-link">+92 331 8457893</a>
            </div>

          </li>

          <li class="footer-item">

            <div class="footer-item-icon">
              <ion-icon name="mail"></ion-icon>
            </div>

            <div>
              <a href="mailto:info@desinic.com" class="footer-item-link">stammerapy@gmail.com</a>
            </div>

          </li>

          <li class="footer-item">

            <div class="footer-item-icon">
              <ion-icon name="location"></ion-icon>
            </div>

            <address class="footer-item-link">
              Karachi, Pakistan
            </address>

          </li>

        </ul>

      </div>
    </div>
  </style>

    <div class="footer-bottom">
      <p class="copyright">
        &copy; 2024 <a href="#" class="copyright-link">Stammerapy</a>. All Right Reserved
      </p>
    </div>

  </footer>






  <!-- 
    - #GO TO TOP
  -->

  <a href="#top" class="go-top  active" aria-label="Go To Top" data-go-top>
    <ion-icon name="arrow-up-outline"></ion-icon>
  </a>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


<script>
  document.addEventListener('DOMContentLoaded', () => {
    const dropbtn = document.getElementById('dropbtn');
    const dropdownContent = document.getElementById('dropdown-content');

    dropbtn.addEventListener('click', (event) => {
        // Prevent the event from propagating to the document
        event.stopPropagation();

        // Toggle the display of the dropdown menu
        if (dropdownContent.style.display === 'block') {
            dropdownContent.style.display = 'none';
        } else {
            dropdownContent.style.display = 'block';
        }
    });

    // Close the dropdown menu if the user clicks outside of it
    window.addEventListener('click', (event) => {
        if (!dropbtn.contains(event.target) && !dropdownContent.contains(event.target)) {
            dropdownContent.style.display = 'none';
        }
    });
});
</script>

</body>

</html>