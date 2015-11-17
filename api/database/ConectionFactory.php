<?php
class ConectionFactory {

    public static function getDB() {
        $conection = self::getConection();
        $db = new NotORM($conection);
        return $db;
    }
    
    private static function getConection() {
        $dbhost = getenv('IP');
        $dbuser = getenv('C9_USER');
        $dbpass = '';
        $dbname = 'c9';
        
        try {
            $conection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        }
        catch(Exception $e) {
           echo $e->getMessage();
           die;
        }
        
        return $conection;
    }
}
?>