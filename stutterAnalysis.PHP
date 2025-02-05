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
  <link rel="stylesheet" href="./assetss/css/styl.css">

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
:root {

  --container-width-lg: 100%;
  /**
   * colors
   */

  --st-patricks-blue: hsl(236, 57%, 28%);
  --amaranth-purple: hsl(335, 88%, 38%);
  --royal-blue-dark: hsl(231, 68%, 21%);
  --chrome-yellow: hsl(39, 100%, 52%);
  --space-cadet-1: hsl(230, 41%, 25%);
  --space-cadet-2: hsl(230, 59%, 16%);
  --winter-sky_50: hsla(335, 87%, 53%, 0.5);
  --purple-navy: hsl(236, 26%, 43%);
  --ksu-purple: hsl(275, 54%, 33%);
  --winter-sky: hsl(335, 87%, 53%);
  --razzmatazz: hsl(335, 87%, 51%);
  --platinum: hsl(0, 0%, 90%);
  --black_70: hsla(0, 0%, 0%, 0.7);
  --rajah: hsl(29, 99%, 67%);
  --white: hsl(0, 0%, 100%);

  --gradient-1: linear-gradient(90deg,var(--royal-blue-dark) 0,var(--ksu-purple) 51%,var(--royal-blue-dark));
  --gradient-2: linear-gradient(90deg,var(--razzmatazz) ,var(--rajah));

  /**
   * typography
   */

  --ff-source-sans-pro: 'Source Sans Pro', sans-serif;
  --ff-poppins: 'Poppins', sans-serif;

  --fs-1: 4.2rem;
  --fs-2: 3.8rem;
  --fs-3: 3.2rem;
  --fs-4: 2.5rem;
  --fs-5: 2.4rem;
  --fs-6: 2rem;
  --fs-7: 1.8rem;
  --fs-8: 1.5rem;

  --fw-500: 500;
  --fw-600: 600;
  --fw-700: 700;

  /**
   * border radius
   */

  --radius-4: 4px;
  --radius-12: 12px;

  /**
   * spacing
   */

  --section-padding: 60px;

  /**
   * transition
   */

  --transition-1: 0.15s ease;
  --transition-2: 0.35s ease;
  --cubic-in: cubic-bezier(0.51, 0.03, 0.64, 0.28);
  --cubic-out: cubic-bezier(0.33, 0.85, 0.56, 1.02);

  /**
   * shadow
   */

  --shadow: 0 5px 20px 1px hsla(220, 63%, 33%, 0.1);

}





/*-----------------------------------*\
  #RESET
\*-----------------------------------*/

*,
*::before,
*::after {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

li { list-style: none; }

a { text-decoration: none; }

a,
img,
span,
button,
ion-icon { display: block; }

button {
  background: none;
  border: none;
  font: inherit;
}

button { cursor: pointer; }

ion-icon { pointer-events: none; }

img { height: auto; }

address { font-style: normal; }

html {
  font-family: var(--ff-poppins);
  font-size: 10px;
  scroll-behavior: smooth;
}

body {
  background-color: var(--white);
  color: var(--purple-navy);
  font-family: var(--ff-poppins);
}

::-webkit-scrollbar { width: 10px; }

::-webkit-scrollbar-track { background-color: hsl(0, 0%, 95%); }

::-webkit-scrollbar-thumb { background-color: hsl(0, 0%, 80%); }

::-webkit-scrollbar-thumb:hover { background-color: hsl(0, 0%, 70%); }





/*-----------------------------------*\
  #REUSED STYLE
\*-----------------------------------*/


.container{
    width: var(--container-width-lg);
    margin: 0 auto;
    padding-inline: 15px;
}

.h2,
.h3 { font-family: var(--ff-source-sans-pro); }

.btn {
  background-image: var(--gradient-2);
  background-size: 200%;
  color: var(--white);
  padding: 12px 35px;
  font-size: var(--fs-8);
  font-weight: var(--fw-500);
  border-radius: 0 25px;
  transition: var(--transition-2);
}

.btn:is(:hover, :focus) { background-position: right; }

.w-100 { width: 100%; }

.banner-animation { animation: waveAnim 2s linear infinite alternate; }

@keyframes waveAnim {
  0% { transform: translate(0, 0) rotate(0); }
  100% { transform: translate(2px, 2px) rotate(1deg); }
}

.section { padding-block: var(--section-padding); }

.section-title {
  color: var(--st-patricks-blue);
  font-size: var(--fs-3);
  margin-block-end: 60px;
  max-width: max-content;
  margin-inline: auto;
}

.underline { position: relative; }

.underline::before {
  content: "";
  position: absolute;
  bottom: -20px;
  left: 50%;
  transform: translateX(-50%);
  width: 70%;
  height: 6px;
  background-image: var(--gradient-2);
  border-radius: 10px;
}

:is(.service-card, .features-card) .title {
  color: var(--st-patricks-blue);
  font-size: var(--fs-4);
  font-weight: var(--fw-700);
}

:is(.service-card, .features-card, .blog-card) .text { font-size: var(--fs-8); }

.img-cover {
  width: 100%;
  height: 100%;
  object-fit: cover;
}





/*-----------------------------------*\
  #HEADER
\*-----------------------------------*/

.header .btn { display: none; }

.header {
  --color: var(--white);
  background-image: var(--gradient-1);

  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  padding-block: 14px;
  z-index: 4;
  transition: var(--transition-1);
}

.header.active {
  --color: var(--st-patricks-blue);

  position: fixed;
  background-color: var(--white);
  box-shadow: 0 2px 30px hsla(0, 0%, 0%, 0.1);
}

.header .container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  gap: 30px;
}

.logo {
  color: var(--color);
  font-family: var(--ff-source-sans-pro);
  font-size: var(--fs-3);
}

.nav-open-btn {
  color: var(--color);
  font-size: 32px;
  padding: 4px;
}

.navbar {
  background-color: var(--ksu-purple);
  position: fixed;
  top: 0;
  left: -280px;
  width: 100%;
  max-width: 280px;
  min-height: 100%;
  padding: 20px;
  visibility: hidden;
  z-index: 2;
  transition: 0.25s var(--cubic-in);
  text-decoration: none;
}

.navbar.active {
  transform: translateX(280px);
  visibility: visible;
  transition: 0.5s var(--cubic-out);
}

.navbar-top {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding-block: 10px 30px;
  text-decoration: none;
}

.navbar-top .logo {
  color: var(--st-patricks-blue);
  font-size: 4.2rem;
  font-weight: var(--fw-700);
}

.nav-close-btn {
  color: var(--space-cadet-1);
  font-size: 2.8rem;
  padding: 4px;
}

.navbar-item:not(:last-child) { border-bottom: 1px solid var(--platinum); }

.navbar-link {
  color: var(--space-cadet-1);
  font-size: var(--fs-8);
  font-weight: var(--fw-600);
  padding-block: 12px;
  text-decoration: none;
}

.overlay {
  position: fixed;
  inset: 0;
  background-color: var(--black_70);
  z-index: 1;
  opacity: 0;
  pointer-events: none;
  transition: var(--transition-2);
}

.overlay.active {
  opacity: 1;
  pointer-events: all;
}


/*-----------------------------------*\
  #FOOTER
\*-----------------------------------*/

.footer { font-size: var(--fs-8); }

.footer a { color: inherit; }

.footer-top {
  background-image: url("./images/footer-bg.png"), var(--gradient-1);
  background-repeat: no-repeat;
  background-size: auto, 200%;
  background-position: center, center;
  color: var(--white);
}

.footer-brand { margin-block-end: 30px; }

.footer-brand .logo {
  font-weight: var(--fw-700);
  margin-block-end: 15px;
}

.footer-brand .text {
  font-size: var(--fs-8);
  margin-block-end: 20px;
}

.social-list {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  gap: 10px;
}

.footer-top .social-link {
  background-color: var(--white);
  color: var(--winter-sky);
  font-size: 18px;
  padding: 8px;
  border-radius: 50%;
}

.footer-top .social-link:is(:hover, :focus) {
  background-image: var(--gradient-2);
  color: var(--white);
}

.footer-list:not(:last-child) { margin-block-end: 25px; }

.footer-list-title {
  font-family: var(--ff-source-sans-pro);
  font-size: var(--fs-5);
  font-weight: var(--fw-700);
  margin-block-end: 15px;
}

.footer-link { padding-block: 5px; }

:is(.footer-link, .footer-item-link):not(address):is(:hover, :focus) { text-decoration: underline; }

.footer-item {
  display: flex;
  justify-content: flex-start;
  align-items: center;
  gap: 10px;
  padding-block: 10px;
}

.footer-item-icon {
  background-image: var(--gradient-2);
  padding: 13px;
  border-radius: 50%;
}

.footer-bottom {
  background-color: var(--space-cadet-2);
  padding: 20px;
  text-align: center;
  color: var(--white);
}

.copyright-link {
  display: inline-block;
  text-decoration: underline;
}

.copyright-link:is(:hover, :focus) { text-decoration: none; }





/*-----------------------------------*\
  #GO TO TOP
\*-----------------------------------*/

.go-top {
  position: fixed;
  bottom: 0;
  right: 15px;
  background-color: var(--winter-sky);
  color: var(--white);
  font-size: 2rem;
  padding: 14px;
  border-radius: var(--radius-4);
  box-shadow: -3px 3px 15px var(--winter-sky_50);
  z-index: 2;
  visibility: hidden;
  opacity: 0;
  transition: var(--transition-1);
}

.go-top.active {
  visibility: visible;
  opacity: 1;
  transform: translateY(-15px);
}





/*-----------------------------------*\
  #MEDIA QUERIES
\*-----------------------------------*/

/**
 * responsive for larger than 550px screen
 */

@media (min-width: 550px) {

  /**
   * REUSED STYLE
   */

  .container {
    max-width: 550px;
    margin-inline: auto;
  }

  .section-title { --fs-3: 3.6rem; }



  /**
   * HEADER
   */

  .header .btn {
    display: flex;
    align-items: center;
    gap: 5px;
    margin-inline-start: auto;
  }


  /**
   * FOOTER
   */

  .footer-brand,
  .footer-list:not(:last-child) { margin-block-end: 0; }

  .footer-top .container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px 50px;
  }

}





/**
 * responsive for larger than 768px screen
 */

@media (min-width: 768px) {

  /**
   * REUSED STYLE
   */

  .container { max-width: 720px; }




  /**
   * FOOTER
   */

  .footer-top .container { grid-template-columns: repeat(3, 1fr); }

}





/**
 * responsive for larger than 992px screen
 */

@media (min-width: 992px) {

  /**
   * CUSTOM PROPERTY
   */

  :root {

    /**
     * typography
     */

    --fs-1: 5.4rem;

  }



  /**
   * REUSED STYLE
   */

  .container { max-width: 950px; }



  /**
   * HEADER
   */

  .header { padding-block: 20px; }

  .overlay,
  .nav-open-btn,
  .navbar-top { display: none; }

  .navbar,
  .navbar.active {
    all: unset;
    margin-inline-start: auto;
  }

  .header .btn { margin-inline-start: 0; }

  .navbar-list {
    display: flex;
    gap: 25px;
  }

  .navbar-item:not(:last-child) { border-bottom: none; }

  .navbar-link { color: var(--color); }



  /**
   * FOOTER
   */

  .footer-top .container { grid-template-columns: repeat(4, 1fr); }

  .footer-brand { grid-column: 1 / 5; }

  .footer-brand .text { max-width: 45ch; }

}





/**
 * responsive for larger than 1200px screen
 */

@media (min-width: 1200px) {

  /**
   * REUSED STYLE
   */

  .container { max-width: 1200px; }

  .section-title { --fs-3: 4.6rem; }




  /**
   * FOOTER
   */

  .footer-top .container { grid-template-columns: 1fr 0.5fr 0.7fr 0.5fr 1fr; }

  .footer-brand { grid-column: auto; }

}


/* General styles */
.middle {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 85vh;
}

/* Container to center everything */
.container1 {
    text-align: center;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    width: 80%;
    max-width: 600px;
}

/* Heading styles */
h1 {
    font-size: 2rem;
    color: #333;
}

/* Reference text */
#reference-text {
    font-size: 1rem;
    color: #555;
    margin-bottom: 20px;
}

/* Highlighting reference text */
#reference-text strong {
    color: #000;
    font-weight: bold;
}

/* Flexbox for buttons */
.button-container {
    display: flex;
    justify-content: center;
    gap: 20px;  /* Adds space between the buttons */
    margin-top: 20px;
}

/* Button styles */
button {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 10px 20px;
    font-size: 1rem;
    cursor: pointer;
    border-radius: 5px;
    transition: background-color 0.3s;
}

button:disabled {
    background-color: #ccc;
    cursor: not-allowed;
}

button:hover {
    background-color: #45a049;
}

/* Status message */
#status {
    font-size: 1rem;
    color: #666;
    margin-top: 20px;
}

/* Result heading */
#result {
    font-size: 1.2rem;
    font-weight: bold;
    color: #333;
    margin-top: 20px;
}

.logo-container {
            display: inline-block;
            padding: 4px;
            width: 60px;
            height: 60px;
        }
        .logo-container img {
            max-width: 100%;
            height: 100%;
            display: block;
        }

        
.go-back {
    position: fixed;
    bottom: 20px;
    left: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    width: 50px;
    height: 50px;
    background-color: #FF007F;
    color: white;
    text-align: center;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease;
  }

  .go-back:hover {
    background-color: #0056b3;
  }

  .go-back ion-icon {
    font-size: 24px;
  }

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
    right: 0px; /* Align the dropdown to the right edge */
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
        <a href="components/user_logout.php" onclick="return confirm('logout from this website?');">Logout</a>        </div>
    </div>

        </ul>

      </nav>

    </div>
  </header>
<div class="middle">
  <div class="container1">
    <h1>Stutter Detection</h1>

    <p id="reference-text">Reference Text: <br><strong>The brave boy quickly jumped over the zigzagging snake in the shadowy forest.</strong></p>

    <div class="button-container">
        <button id="startBtn">Start Recording</button>
        <button id="stopBtn" disabled>Stop Recording</button>
    </div>

    <p id="status">Press "Start Recording" to begin.</p>
    <h3 id="result"></h3>
</div>

</div>
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

  <script>
    document.getElementById("startBtn").addEventListener("click", async () => {
        try {
            let response = await fetch("http://127.0.0.1:5000/start_recording", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
            });

            let data = await response.json();
            console.log("Started:", data.message);

            document.getElementById("status").innerText = "Recording started...";
            document.getElementById("stopBtn").disabled = false;
        } catch (error) {
            console.error("Error starting recording:", error);
            document.getElementById("status").innerText = "Error starting recording!";
        }
    });

    document.getElementById("stopBtn").addEventListener("click", async () => {
        try {
            let response = await fetch("http://127.0.0.1:5000/stop_recording", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
            });

            let data = await response.json();
            console.log("Stopped:", data);

            if (data.stutter_detected) {
                let percentage = data.stutter_percentage;
                let recommendedPlan = "";

                if (percentage >= 80) {
                    recommendedPlan = "Advanced Plan";
                } else if (percentage >= 60) {
                    recommendedPlan = "Intermediate Plan";
                } else {
                    recommendedPlan = "Basic Plan";
                }

                document.getElementById("status").innerText = `Stuttering detected!`;
                document.getElementById("result").innerHTML = 
                    `Stutter Percentage: ${percentage}% <br> Recommended Plan: ${recommendedPlan}`;
            } else {
                document.getElementById("status").innerText = "No stuttering detected.";
                document.getElementById("result").innerText = "";
            }

            document.getElementById("stopBtn").disabled = true;
        } catch (error) {
            console.error("Error stopping recording:", error);
            document.getElementById("status").innerText = "Error stopping recording!";
        }
    });


    // Close the dropdown menu if the user clicks outside of it
    window.addEventListener('click', (event) => {
        if (!dropbtn.contains(event.target) && !dropdownContent.contains(event.target)) {
            dropdownContent.style.display = 'none';
        }
    });

</script>

  <!-- 
    - custom js link
  -->
  <script src="./assetss/js/script.js"></script>

  <!-- 
  - #GO BACK
-->

<a href="javascript:history.back()" class="go-back active" aria-label="Go Back">
  <ion-icon name="arrow-back-outline"></ion-icon>
</a>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>
