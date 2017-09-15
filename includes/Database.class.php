<?php

    /**         
    * authon    :   zhihua
    * time      :   20170903
    * function  :   connect to the database and execute the SQL statement
    * 功能       :   连接数据库，并执行sql 语句
    */

    class Database
    {
        // MySQL主机
        // static private $databaseAddr = 'mysql.hostinger.com.hk';
        static private $databaseAddr = 'www.php6.org';
        // MySQL数据库名称
        static private $databaseName = 'u552958104_data';
        // MySQL用户名
        static private $databaseUser = 'u552958104_zhihu';
        // password
        static private $databasePassword = 'Mysql@587s(2017)';
        // database link
        private static $dbLink = false;
        // error text
        private $errorText = "";

        public function __construct() 
        {
            try
            {
                self::$dbLink = null;
                self::$dbLink = new PDO('mysql:dbname='.self::$databaseName.';host='.self::$databaseAddr.';charset=utf8', self::$databaseUser, self::$databasePassword);
                self::$dbLink->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                self::$dbLink->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->setErrorText('');
            } 
            catch(PDOException $e)
            {
                self::$dbLink = false;
                $this->setErrorText('Error:'.$e->getMessage());
            }
        }

        // Add error message
        // 添加错误信息
        private function setErrorText($errorText)
        {
            $this->errorText = $errorText;
        }

        // Gets the variable errorText content
        // 获取变量errorText内容
        public function getErrorText()
        {
            return $this->errorText;
        }

        // if error return true
        public function isError()
        {
            return self::dbLink;
        }

        // execute sql statement
        public static function executeSQL($SQL, $list)
        {
            // Execute SQL 
            try {
                $result = self::$dbLink->prepare($SQL);
                $result->execute($list);
                return $result;
            } catch(PDOException $e) {
                $this->$errorText = ('failded : '.$e->getMessage());
                die($e->getMessage());
            }
        }

        // return database link
        // 返回数据库的链接
        public static function getDB()
        {
            return self::$dbLink;
        }
    }
?>