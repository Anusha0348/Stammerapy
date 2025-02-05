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
        }

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




    </style>
</head>
<body>
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
            <img src="<?= htmlspecialchars($row['image']); ?>" alt="Profile Picture" style="width: 100px; height: 100px; border-radius: 50%;">
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

