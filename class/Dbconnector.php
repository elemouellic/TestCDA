<?php

abstract class DbConnector
{
  
  // Singleton 
  private static $bdd = null;

  // Connexion à la base de données
  public static function dbConnect()
  {

    $dsn = "mysql:dbname=testcda;host=localhost;port=3306;charset=utf8";
    $user = "root" ;
    $pwd = "";

    
    if (isset(self::$bdd)) {
      return self::$bdd;
    } else {
      try {
        self::$bdd = new PDO($dsn, $user, $pwd);
        self::$bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return self::$bdd;
      } catch (PDOException $e) {
        throw new Exception("Une erreur s'est produite");
    }
    
    }
  }
  

}

?>