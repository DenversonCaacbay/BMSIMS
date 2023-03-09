<?php 
    require 'config.php';

    //class based connection
    class Connection
    {

        public static function make($host, $db, $user, $password){
            $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

            try{
                $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

                if($pdo){
                    // echo "Connection Success!";
                    return $pdo;
                }
            }catch (PDOException $e){
                echo $e->getMessage();
            }
        }
    }
    
    return Connection::make($host, $db, $user, $password);
?>