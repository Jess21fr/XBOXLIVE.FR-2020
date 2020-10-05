<?php ob_start(); ?>


<?php
  if (isset($succMsg)) {
    echo $succMsg;
  } elseif (isset($errMsg)) {
    echo $errMsg;
  }

 ?>

<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
