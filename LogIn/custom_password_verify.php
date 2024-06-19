<?php
function extract_salt_from_hash($hash) {
    // The salt is the first 29 characters for bcrypt
    return substr($hash, 0, 29);
}

function custom_password_verify($password, $hash) {
    $salt = extract_salt_from_hash($hash);
    echo "Salt: " . $salt;
    // Hash the input password with the extracted salt
    $hashed_password = crypt($password, $salt);
    echo "Hashed password: " . $hashed_password;
    return hash_equals($hashed_password, $hash);
}
?>