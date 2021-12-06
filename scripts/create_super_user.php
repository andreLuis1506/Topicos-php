<?php

echo "Create super user XD\n\n";

$usename = readline("Enter username: ");
$email = readline("Enter email: ");
$primary_passwd = readline("Enter primary password: ");
$secondary_passwd = readline("Enter secondary password: ");

if(strlen($usename) > 0 and strlen($primary_passwd) > 0 and strlen($secondary_passwd) > 0){
  $connection  = new PDO('mysql:host=mysqldb;port=3306;dbname=aula_php', 'root', 'root');
  $primary_passwd = password_hash($primary_passwd, PASSWORD_BCRYPT);
  $secondary_passwd = password_hash($secondary_passwd, PASSWORD_BCRYPT);
  $sql = "INSERT INTO `usuario` (`login`, `senha`, `criacao`, `email`, `status`, `senha_assinatura`) VALUES ('". $usename ."', '" . $primary_passwd . "', CURRENT_TIMESTAMP, '" . $email . "', '1', '" . $secondary_passwd . "') ";
  $connection->exec($sql);
  echo "New record created successfully\n\n";
} else {
  echo "Error!";
}


