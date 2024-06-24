<?php
session_start();
session_unset();
session_destroy();
header("Location: ../BookReviewer/index.html"); 
exit;
?>