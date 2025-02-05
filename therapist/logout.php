<?php

   include 'connect.php';

   setcookie('therapist_id', '', time() - 1, '/');

   header('location:../therapist/login.php');

?>