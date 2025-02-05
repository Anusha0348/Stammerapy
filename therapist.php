<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

// Fetch user details
$select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
$select_user->execute([$user_id]);

if ($select_user->rowCount() > 0) {
    $row = $select_user->fetch(PDO::FETCH_ASSOC);
} else {
    echo "User not found!";
    exit;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $appointment_date = $_POST['appointment_date'];
    $appointment_time = $_POST['appointment_time'];
    $communication_medium = $_POST['communication_medium'];

    try {
        // Check if the appointment slot is already booked
        $stmt = $conn->prepare("SELECT * FROM appointments WHERE appointment_date = :appointment_date AND appointment_time = :appointment_time");
        $stmt->bindParam(':appointment_date', $appointment_date);
        $stmt->bindParam(':appointment_time', $appointment_time);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $message = "This date and time slot is already booked. Please choose another.";
        } else {
            // Insert the new appointment
            $stmt = $conn->prepare("INSERT INTO appointments (name, number, email, appointment_date, appointment_time, communication_medium) VALUES (:name, :number, :email, :appointment_date, :appointment_time, :communication_medium)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':number', $number);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':appointment_date', $appointment_date);
            $stmt->bindParam(':appointment_time', $appointment_time);
            $stmt->bindParam(':communication_medium', $communication_medium);

            if ($stmt->execute()) {
                $message = "Appointment booked successfully!";
            } else {
                $message = "Error: Unable to book the appointment.";
            }
        }
    } catch (PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }

echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                alert('$message'); 
            });
          </script>";
}

?>
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
  #CONTACTUS
\*-----------------------------------*/
.contact__container{
    background: var(--gradient-1);
    padding: 3rem;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    height: 40rem;
    margin: 7rem auto ;
    border-radius: 1rem;
}

/* =====================ASIDE=======================*/

.contact__aside{
    background: var(--gradient-2);

    padding: 3rem;
    border-radius: 1rem;
    position: relative;
    bottom: 10rem;
    left: 3.9rem;
    width: 400px;
    height: 550px;
}
.aside__image{
    width: 15rem;
    margin-bottom: 2rem;
}

.contact__aside h2{
    text-align: left;
    margin-bottom: 1rem;
}

.contact__aside p{
    font-size: 1.5rem;
    margin-bottom: 4rem;
}

.contact__details li {
    display: flex;
    font-size: 1.5rem;
    gap: 0.9rem;
    align-items: center;
    margin-bottom: 3rem;
}

.contact__socials{
    display: flex;
    gap: 1.5rem;
    margin-top: 4rem;
}

.contact__socials a{
    background: var(--gradient-1);
    color: white;
    padding: 0.5rem;
    border-radius: 50%;
    font-size: 1.8rem;
    transition: var(--transition);
}

.contact__socials a:hover{
    background: transparent;
}


.contact__form {
    display: flex;
    flex-direction: column;
    gap: 1.2rem;
    margin-left: 0.1rem;
    margin-right: 7rem;
}

.form__name{
    display: flex;
    background-color: white;
    border: none;
    gap: 1.2rem;
}

input, textarea{
    width: 100%;
    padding: 1.2rem;
}

.contact__form .btn{
    width: max-content;
    margin-top: 1rem;
    cursor: pointer;
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
   * ABOUT
   */

  .stats-list { grid-template-columns: repeat(3, 1fr); }



  /**
   * BLOG
   */

  .blog-card {
    display: grid;
    grid-template-columns: 0.75fr 1fr;
    gap: 20px;
    padding: 30px;
  }

  .blog-card .banner { margin-block-end: 0; }

  .blog-card .banner a { height: 100%; }



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
   * HERO
   */

  .hero {
    min-height: 600px;
    display: grid;
    place-items: center;
  }

  .hero-content { margin-block-end: 0; }

  .hero .container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    align-items: center;
    gap: 30px;
  }



  /**
   * SERVICE
   */

  .service-list { grid-template-columns: 1fr 1fr; }



  /**
   * FEATURES
   */

  .features-list > li:first-child { margin-block-end: 0; }

  .features-list {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 25px;
  }



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
   * HERO
   */

  .hero { min-height: 700px; }



  /**
   * ABOUT
   */

  .about .container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 30px;
  }



  /**
   * SERVICE
   */

  .service-list { grid-template-columns: repeat(3, 1fr); }



  /**
   * FEATURES
   */

  .features-list { grid-template-columns: 1fr; }

  .features .container {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
  }

  .features .section-title { grid-column: 1 / 4; }

  .features-banner {
    margin-block: 0;
    display: grid;
    place-items: center;
  }



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
   * HERO
   */

  .hero { min-height: 800px; }



  /**
   * BLOG
   */

  .blog-list { grid-template-columns: 1fr 1fr; }

  .blog-card { height: 100%; }

  .blog-card .content {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }



  /**
   * FOOTER
   */

  .footer-top .container { grid-template-columns: 1fr 0.5fr 0.7fr 0.5fr 1fr; }

  .footer-brand { grid-column: auto; }

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
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease;
  }


  .go-back:hover {
    background-color: #0056b3;
  }

  .go-back ion-icon {
    font-size: 24px;
  }

  .content {
            text-align: center;
            color: #fff;
            padding: 80px 20px;
            justify-items: center
        }

        .content h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            color: black;
        }

        .content p {
            font-size: 1.9rem;
            margin-bottom: 15px;
            color: rgba(10, 10, 10, 0.8);
            text-align: center;
            padding: 20px;
            
        }

        .btn,
        .view-btn {
            background: #ff007f;
            border: none;
            color: #fff;
            padding: 12px 30px;
            font-size: 1.4rem;
            border-radius: 5px;
            cursor: pointer;
            display: inline-block;
            margin: 10px;
        }

        .btn:hover 
        .view-btn:hover {
            background: #e60073;
        }

       

.button-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px; /* Adjust as needed */
}
        
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom,rgb(234, 230, 238),rgb(252, 247, 251));
        }

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;    
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            width: 28%;
            text-align: center;
        }
        .modal-content form input,
        .modal-content form select,
        .modal-content form button {
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1.4rem;
        }
        .message {
            margin-top: 20px;
            font-size: 1rem;
            color: red;
        }

        .modal-content form label {
    font-size: 13px;
    font-weight: bold;
    display: block;
    margin-bottom: 2px;
    text-align: left;
    color: #333;
}

.modal-content form input,
.modal-content form select {
    margin-bottom: 15px;
}



.logo-container {
    display: inline-block;
    width: 60px;
    height: 60px;
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

          <button class="nav-close-btn" aria-label="Close Menu" data-nav-close-btn>
            <ion-icon name="close-outline"></ion-icon>
          </button>
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
    </div>

        </ul>

      </nav>

    </div>
  </header>

</br>
</br>
</br>
</br>
</br>
</br>


  <main>
    <article>
    <section>
    <div class="content">
    <h2 class="h2 section-title underline">Therapist Appointment</h2>
        <p>"As a speech therapist, my goal is to empower individuals to communicate with confidence and clarity. Every session is an opportunity to help someone unlock their full potential through personalized care and proven techniques. Together, we can overcome challenges and make meaningful progress on the journey to effective communication."</p>
        <button class="btn" id="bookAppointment">Book Appointment</button>
        <a href="viewAppointment.php"><button class="view-btn" id="viewAppointment">View Appointments</button></a>
    </div>

    <div class="modal" id="appointmentModal">
        <div class="modal-content">
            <h2>Book An Appointment</h2>
            <form method="POST" action="">
    <label for="name">Name: </label><input type="text" id="name" name="name" placeholder="Name" required pattern="^[A-Za-z]{4,}$" title="Name must only contain alphabets and be at least 4 characters long">
    <label for="number">Phone: </label><input type="tel" id="number" name="number" placeholder="Phone Number" required  pattern="^0\d{10}$" title="Phone number must start with 0 and consist of 11 digits">
    <label for="email">Email: </label><input type="email" id="email" name="email" placeholder="Email Address" required>
    <label for="appointment_date">Appointment Date: </label><input type="date" id="appointment_date" name="appointment_date" required>
    <label for="appointment_time">Appointment Time: </label><select id="appointment_time" name="appointment_time" required>
        <option value="" disabled selected>Select Time Slot</option>
        <option value="09:00 - 10:00">09:00 - 10:00</option>
        <option value="10:00 - 11:00">10:00 - 11:00</option>
        <option value="11:00 - 12:00">11:00 - 12:00</option>
        <option value="13:00 - 14:00">13:00 - 14:00</option>
        <option value="14:00 - 15:00">14:00 - 15:00</option>
        <option value="15:00 - 16:00">15:00 - 16:00</option>
        <option value="16:00 - 17:00">16:00 - 17:00</option>
    </select>
    <label for="communication_medium">Communication Medium: </label><select id="communication_medium" name="communication_medium" required>
        <option value="" disabled selected>Communication Medium</option>
        <option value="Zoom Call">Zoom Call</option>
        <option value="WhatsApp Call">WhatsApp Call</option>
    </select>
    <button type="submit">Submit</button>
</form>
            <?php if (!empty($message)) : ?>
                <div class="message"><?= htmlspecialchars($message) ?></div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        const bookAppointment = document.getElementById('bookAppointment');
        const modal = document.getElementById('appointmentModal');

        bookAppointment.addEventListener('click', () => {
            modal.style.display = 'flex';
        });

        window.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.style.display = 'none';
            }

         // Keep modal open if there was an error message
         if (message && message !== "Appointment booked successfully!") {
            modal.style.display = "flex";
        }

        });
    </script>
     
</section>




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
            <a href="exercise.php" class="footer-link">Exercises</a>
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
  - #GO BACK
-->

<a href="javascript:history.back()" class="go-back active" aria-label="Go Back">
  <ion-icon name="arrow-back-outline"></ion-icon>
</a>

  <!-- 
    - #GO TO TOP
  -->

  <a href="#top" class="go-top  active" aria-label="Go To Top" data-go-top>
    <ion-icon name="arrow-up-outline"></ion-icon>
  </a>

  <!-- 
    - custom js link
  -->
  <script src="./assetss/js/script.js"></script>

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

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let dateInput = document.querySelector('input[name="appointment_date"]');
        
        // Set the minimum date to today
        let today = new Date().toISOString().split("T")[0];
        dateInput.setAttribute("min", today);

        // Disable Sundays
        dateInput.addEventListener("input", function () {
            let selectedDate = new Date(this.value);
            if (selectedDate.getDay() === 0) {
                alert("Appointments cannot be booked on Sundays. Please select another date.");
                this.value = ""; // Reset the field
            }
        });
    });
</script>


</body>

</html>