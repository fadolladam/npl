$password = 'mypassword'; // Your plain text password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

echo $hashedPassword;
