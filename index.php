<?php
  session_start();

  include('assets/includes/db.php');

  include ('assets/includes/header.php');
?>

<div class="video-container">
  <video loop muted autoplay>
    <source src="assets/img/employee_loop.mp4" type="video/mp4">
  </video>

  <?php include('assets/includes/cards.php'); ?>
</div>


<?php include ('assets/includes/footer.php'); ?>
