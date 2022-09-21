<?php
$username = $_POST['username'];
$password = $_POST['password'];

if ($username == "username" && $password == "password") { 
echo "Başarılı";
}
else {
echo "Hatalı Giriş";
}

?>