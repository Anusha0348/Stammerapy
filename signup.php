<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}
if(isset($_POST['submit'])){

   $id = unique_id(); // Generates a unique ID for the user
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING); // Sanitize the name input
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING); // Sanitize the email input
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING); // Sanitize the password input
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING); // Sanitize the confirm password input

   $image = $_FILES['image']['name']; // Get the image file name
   $image = filter_var($image, FILTER_SANITIZE_STRING); // Sanitize the image file name

   if(!empty($image)) {
      // If an image was uploaded, process the image
      $ext = pathinfo($image, PATHINFO_EXTENSION); // Get the image file extension
      $rename = unique_id().'.'.$ext; // Rename the image with a unique ID
      $image_size = $_FILES['image']['size']; // Get the image size
      $image_tmp_name = $_FILES['image']['tmp_name']; // Get the temporary file name
      $image_folder = 'uploaded_files/'.$rename; // Set the folder path to save the image

      move_uploaded_file($image_tmp_name, $image_folder); // Move the uploaded file to the specified folder
   } else {
      // If no image was uploaded, use a default silhouette image
      $rename = 'silhouette.jpg'; // Ensure this matches the actual file name and path in your project
   }

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email]);

   if($select_user->rowCount() > 0){
      $message[] = 'Email already taken!';
   } else {
      if($pass != $cpass){
         $message[] = 'Confirm password not matched!';
      } else {
         // Insert the user details into the database
         $insert_user = $conn->prepare("INSERT INTO `users`(id, name, email, password, image) VALUES(?,?,?,?,?)");
         $insert_user->execute([$id, $name, $email, $pass, $rename]);

         $verify_user = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
         $verify_user->execute([$email, $pass]);
         $row = $verify_user->fetch(PDO::FETCH_ASSOC);

         if($verify_user->rowCount() > 0){
             // Set a cookie for the logged-in user
            header('location:signin.php'); // Redirect to the login page
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="stylesignup.css">
    <title>Stammerapy</title>
    <style type="">
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap');

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Montserrat', sans-serif;
}
:root{
    --royal-blue-dark: hsl(231, 68%, 21%);
    --ksu-purple: hsl(275, 54%, 33%);
}

body{
    background-color: var(--ksu-purple);
    background: linear-gradient(90deg,#e2e2e2 0,#e2e2e2 51%,var(--ksu-purple));
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    height: 100vh;
}

.container{
    background-color: #fff;
    border-radius: 30px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.35);
    position: relative;
    overflow: hidden;
    width: 768px;
    max-width: 100%;
    min-height: 480px;
}

.container p{
    font-size: 14px;
    line-height: 20px;
    letter-spacing: 0.3px;
    margin: 20px 0;
}

.container span{
    font-size: 12px;
}

.container a{
    color: #333;
    font-size: 13px;
    text-decoration: none;
    margin: 15px 0 10px;
}

.container button{
    background: linear-gradient(90deg,var(--royal-blue-dark) 0,var(--ksu-purple) 51%,var(--royal-blue-dark));;
    color: #fff;
    font-size: 12px;
    padding: 10px 45px;
    border: 1px solid transparent;
    border-radius: 8px;
    font-weight: 600;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    margin-top: 10px;
    cursor: pointer;
}

.container button.hidden{
    background-color: transparent;
    border-color: #fff;
}

.container form{
    background-color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 40px;
    height: 100%;
}

.container input{
    background-color: #eee;
    border: none;
    margin: 8px 0;
    padding: 10px 15px;
    font-size: 13px;
    border-radius: 8px;
    width: 100%;
    outline: none;
}

.form-container{
    position: absolute;
    top: 0;
    height: 100%;
    transition: all 0.6s ease-in-out;
}

.sign-up{
    left: 0;
    width: 50%;
    z-index: 2;
}

.container.active .sign-up{
    transform: translateX(100%);
}

.sign-in{
    left: 0;
    width: 50%;
    opacity: 0;
    z-index: 1;
}

.container.active .sign-in{
    transform: translateX(100%);
    opacity: 1;
    z-index: 5;
    animation: move 0.6s;
}

@keyframes move{
    0%, 49.99%{
        opacity: 0;
        z-index: 1;
    }
    50%, 100%{
        opacity: 1;
        z-index: 5;
    }
}

.login-link {
    font-weight: bold; /* Makes the text bold */
    color: #512da8; /* Use the same blue color as your background */
    text-decoration: none; /* Removes underline */
    transition: color 0.3s ease;
}

.login-link:hover {
    color: var(--ksu-purple); /* Optional: changes color on hover for a nice effect */
}

.social-icons{
    margin: 20px 0;
}

.social-icons a{
    border: 1px solid #ccc;
    border-radius: 20%;
    display: inline-flex;
    justify-content: center;
    align-items: center;
    margin: 0 3px;
    width: 40px;
    height: 40px;
}

.toggle-container{
    position: absolute;
    top: 0;
    left: 50%;
    width: 50%;
    height: 100%;
    overflow: hidden;
    transition: all 0.6s ease-in-out;
    border-radius: 150px 0 0 100px;
    z-index: 1000;
}

.container.active .toggle-container{
    transform: translateX(-100%);
    border-radius: 0 150px 100px 0;
}

.toggle{
    background-color: var(--ksu-purple);
    height: 100%;
    background: linear-gradient(90deg,var(--royal-blue-dark) 0,var(--ksu-purple) 51%,var(--royal-blue-dark));
    color: #fff;
    position: relative;
    left: -100%;
    height: 100%;
    width: 200%;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
}

.container.active .toggle{
    transform: translateX(50%);
}

.toggle-panel{
    position: absolute;
    width: 50%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    padding: 0 30px;
    text-align: center;
    top: 0;
    transform: translateX(0);
    transition: all 0.6s ease-in-out;
}

.toggle-left{
    transform: translateX(-200%);
}

.container.active .toggle-left{
    transform: translateX(0);
}

.toggle-right{
    right: 0;
    transform: translateX(0);
}

.container.active .toggle-right{
    transform: translateX(200%);
}
    </style>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form name="RegForm" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                <h1>Register</h1><br>
                <input type="text" id="name" name="name" placeholder="Name" required>
                <span id="name-error" class="error-message"></span>
                <input type="email" id="email" name="email" placeholder="Email" required>
                <span id="email-error" class="error-message"></span>
                <input type="password" id="password" name="pass" placeholder="Password" required>
                <span id="password-error" class="error-message"></span>
                <input type="password" id="cpass" name="cpass" placeholder="Confirm Password" required>
                <span id="confirm-password-error" class="error-message"></span>
                <input type="file" name="image" accept="image/*" placeholder="Upload Photo">
                <p class="link">Already have an Account? <a href="signin.php" class="login-link">Login Now</a></p>
                <button type="submit" name="submit">Register</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="" method="post" enctype="multipart/form-data">
                <h1>Login</h1><br>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="pass" placeholder="Password" required>
                <br>
                <button type="submit" name="submit">Login</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-right">
                    <h1>Welcome Back!</h1>
                    <p>New to Stammerapy? Register now to start your journey toward fluent communication.</p>
                </div>
                <div class="toggle-panel toggle-left">
                    <h1>Find your voice.</h1>
                    <p>New to Stammerapy? Register now to start your journey toward fluent communication.</p>
                    <button class="hidden" id="register">Register</button>
                </div>
            </div>
        </div>
    </div>

    <script>
    function validateForm() {
    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const password = document.getElementById("password").value;
    const cpass = document.getElementById("cpass").value;
    const nameError = document.getElementById("name-error");
    
    const emailError = document.getElementById(
        "email-error"
    );
    const passwordError = document.getElementById(
        "password-error"
    );
    const confirmpasswordError = document.getElementById(
        "confirm-password-error"
    );

    nameError.textContent = "";
    emailError.textContent = "";
    passwordError.textContent = "";
    confirmpasswordError.textContent = "";

    let isValid = true;

    if (name === "" || /\d/.test(name)) {
        nameError.textContent =
            "Please enter your name properly.";
        isValid = false;
    }

    if (email === "" || !email.includes("@") || !email.endsWith('.com')) {
        emailError.textContent =
            "Please enter a valid email address.";
        isValid = false;
    }

    if (password === "" || password.length < 8 || !/[A-Z]/.test(password) || !/[0-9]/.test(password) || !/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
        passwordError.textContent =
            "Please enter a password with at least 8 characters, 1 uppercase letter, 1 number and 1 special character.";
        isValid = false;
    }

    if (cpass === "" || cpass !== password) {
        passwordError.textContent =
            "Passwords do not match.";
        isValid = false;
    }

    return isValid;
}
    </script>
</body>

</html>
