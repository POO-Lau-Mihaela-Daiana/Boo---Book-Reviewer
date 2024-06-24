<?php
$hashed_password = '$2y$10$hYCmsP8Pb.1aOUOLuHiEc.EwSL8HrF1KBO.V1nBTQHq'; 
$password = 'vlad'; 

if (password_verify($password, $hashed_password)) {
    echo "Password is correct!";
} else {
    echo "Incorrect password.";
}
?>
