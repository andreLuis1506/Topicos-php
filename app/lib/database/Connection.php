<?php 

abstract class connection {
  private static $connection; 
  public static function getConnection(){
    if(self::$connection == null){
      self::$connection  = new PDO('mysql:host=localhost; dbname=aula-php', 'root', 'root');
    }

    return self::$connection;
  }
}