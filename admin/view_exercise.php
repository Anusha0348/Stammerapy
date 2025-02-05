<?php

include '../components/connect.php';

if(isset($_COOKIE['tutor_id'])){
   $tutor_id = $_COOKIE['tutor_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:exercise.php');
}

if(isset($_POST['delete_video'])){

   $delete_id = $_POST['video_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $delete_video_thumb = $conn->prepare("SELECT thumb FROM `exercise` WHERE id = ? LIMIT 1");
   $delete_video_thumb->execute([$delete_id]);
   $fetch_thumb = $delete_video_thumb->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_files/'.$fetch_thumb['thumb']);

   $delete_video = $conn->prepare("SELECT exercises FROM `exercise` WHERE id = ? LIMIT 1");
   $delete_video->execute([$delete_id]);
   $fetch_video = $delete_video->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_files/'.$fetch_video['exercises']);

   $delete_exercise = $conn->prepare("DELETE FROM `exercise` WHERE id = ?");
   $delete_exercise->execute([$delete_id]);
   header('location:exercise.php');
    
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>view Exercise</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>


<section class="view-content">

   <?php
      $select_exercise = $conn->prepare("SELECT * FROM `exercise` WHERE id = ? AND tutor_id = ?");
      $select_exercise->execute([$get_id, $tutor_id]);
      if($select_exercise->rowCount() > 0){
         while($fetch_exercise = $select_exercise->fetch(PDO::FETCH_ASSOC)){
            $video_id = $fetch_exercise['id'];

   ?>
   <div class="container">
      <video src="../uploaded_files/<?= $fetch_exercise['exercises']; ?>" autoplay controls poster="../uploaded_files/<?= $fetch_exercise['thumb']; ?>" class="video"></video>
      <h3 class="title"><?= $fetch_exercise['title']; ?></h3>
      <div class="description"><?= $fetch_exercise['description']; ?></div>
      <form action="" method="post">
         <div class="flex-btn">
            <input type="hidden" name="video_id" value="<?= $video_id; ?>">
            <a href="update_exercise.php?get_id=<?= $video_id; ?>" class="option-btn">update</a>
            <input type="submit" value="delete" class="delete-btn" onclick="return confirm('delete this exercise video?');" name="delete_video">
         </div>
      </form>
   </div>
   <?php
    }
   }else{
      echo '<p class="empty">no exercises added yet! <a href="add_exercise.php" class="btn" style="margin-top: 1.5rem;">add videos</a></p>';
   }
      
   ?>

</section>
   

<?php include '../components/footer.php'; ?>

<script src="../js/admin_script.js"></script>

</body>
</html>