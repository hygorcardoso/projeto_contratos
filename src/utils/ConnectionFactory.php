<?php
    class ConnectionFactory {
        private static $host = "localhost";
        private static $db = "unico";
        private static $db_user = "postgres";
        private static $db_password = "PO@2003us";
        private static $con = null;

        public static function getConnection() {
            if(!self::$con){
                $dsn = "pgsql:host=" . self::$host . ";dbname=" . self::$db;
                self::$con = new PDO($dsn, self::$db_user, self::$db_password, array(PDO::ATTR_PERSISTENT => true));
            }
            return self::$con;
        }
    }
?>
