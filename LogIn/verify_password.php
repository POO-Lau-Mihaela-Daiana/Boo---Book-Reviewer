<?php
$hashed_password = '$2y$10$hYCmsP8Pb.1aOUOLuHiEc.EwSL8HrF1KBO.V1nBTQHq'; // Replace with the actual hashed password from the database
$password = 'vlad'; // Replace with the plaintext password you are testing

if (password_verify($password, $hashed_password)) {
    echo "Password is correct!";
} else {
    echo "Incorrect password.";
}
?>
