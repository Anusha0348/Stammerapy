<?php 
include 'components/connect.php';

// Check if user is signed in
if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
    header('location:login.php'); // Redirect to login page if not signed in
    exit;
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

// Initialize success message variable
$success_message = "";

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Handle profile picture upload
    if (isset($_FILES['profile_picture']['name']) && $_FILES['profile_picture']['name'] != '') {
        $image_name = $_FILES['profile_picture']['name'];
        $image_tmp_name = $_FILES['profile_picture']['tmp_name'];
        $image_folder = 'uploaded_images/' . $image_name;
        move_uploaded_file($image_tmp_name, $image_folder);
    } else {
        $image_folder = $row['image'];
    }

    // Update database
    $update_user = $conn->prepare("UPDATE `users` SET name = ?, email = ?, image = ? WHERE id = ?");
    $update_user->execute([$name, $email, $image_folder, $user_id]);

    // Handle password change
    if (!empty($old_password) && !empty($new_password) && $new_password === $confirm_password) {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_password = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
        $update_password->execute([$hashed_password, $user_id]);
    }

    // Set success message
    $success_message = "Your profile has been updated.";

    header('Location: profile.php?updated=true'); // Redirect to show updated content
    exit;
}

// Check if the update button was clicked
$is_update_mode = isset($_GET['action']) && $_GET['action'] === 'update';
$updated = isset($_GET['updated']) ? $_GET['updated'] : false;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
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
    <title>Profile</title>
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #f9fafc;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-size: 1.6rem;
        }

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





        .profile-form {
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            width: 360px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .profile-form:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .profile-form h2 {
            text-align: center;
            margin-bottom: 24px;
            color: #333;
        }

        .profile-form input[type="text"],
        .profile-form input[type="email"],
        .profile-form input[type="password"],
        .profile-form input[type="file"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 6px;
            border: 1px solid #ddd;
            background-color: #fafafa;
            transition: border-color 0.2s ease;
        }

        .profile-form input[type="text"]:focus,
        .profile-form input[type="email"]:focus,
        .profile-form input[type="password"]:focus,
        .profile-form input[type="file"]:focus {
            border-color: #6c63ff;
            outline: none;
            background-color: #ffffff;
        }

        .profile-form button {
            background: #6c63ff;
            color: #ffffff;
            padding: 12px;
            width: 100%;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            text-transform: uppercase;
            transition: background-color 0.2s ease, box-shadow 0.2s ease;
        }

        .profile-form button:hover {
            background: #574b90;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .action-link {
            display: block;
            text-align: center;
            margin: 16px 0;
            color: #6c63ff;
            text-decoration: none;
            font-size: 14px;
        }

        .action-link:hover {
            text-decoration: underline;
        }

        .profile-form img {
            display: block;
            margin: 10px auto;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #ddd;
        }

        $profile_picture = $row['image'] ?: 'default-avatar.png';

        @media (max-width: 480px) {
            .profile-form {
                width: 90%;
                padding: 20px;
            }
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


    </style>
</head>
<body>
    <!-- 
    - #HEADER
  -->

  <header class="header" data-header>
    <div class="container">

      <div class="overlay" data-overlay></div>

      <div class="logo-container">
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

        </ul>
      </nav>

    </div>
  </header>


    
    <?php if ($is_update_mode): ?>
        <form class="profile-form" action="" method="post" enctype="multipart/form-data">
            <h2>Update Profile</h2>
            <input type="text" name="name" placeholder="Name" value="<?= htmlspecialchars($row['name']); ?>">
            <input type="email" name="email" placeholder="Email" value="<?= htmlspecialchars($row['email']); ?>">
            <input type="file" name="profile_picture">
            <input type="password" name="old_password" placeholder="Old Password" required>
            <input type="password" name="new_password" id="new_password" placeholder="New Password" required>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required>
            <button type="submit" name="update_profile">Update Now</button>
            <a href="?" class="action-link">Cancel</a>
        </form>
    <?php else: ?>
        <div class="profile-form">
            <h2>View Profile</h2>
            <?php if ($updated): ?>
                <p style="color: green; font-weight: bold; text-align: center;">Your profile has been updated.</p>
            <?php endif; ?>
            <p><strong>Name:</strong> <?= htmlspecialchars($row['name']); ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($row['email']); ?></p>
            <p><strong>Profile Picture:</strong></p>
            <img src="uploaded_files/<?= $fetch_content['image']; ?>" alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 50%;">
            <a href="?action=update" class="action-link">Update Profile</a>
            <a href="homiee.php" class="action-link">Cancel</a>
        </div>
    <?php endif; ?>
</body>
</html>

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



  <!-- 
    - custom js link
  -->
  <script src="./assetss/js/script.js"></script>

  <!-- 
    - ionicon link
  -->
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
