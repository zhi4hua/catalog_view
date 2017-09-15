<?php

/**
* author    :   zhihua
* time      :   20170903
* objective :   Log each user's informaion, if the user name , user password
*/

class User
{
    private $user_id;
    private $user_mail;
    private $user_password;
    private $user_name;
    private $registration_time;
    private $activation = 'false';
    private static $tableName = TABLE_PREFIX.'user';

    function __construct($userMail, $userPassword)
    {
        $this->user_mail = $userMail;
        $this->user_password = $userPassword;
        $this->user_name = '';
        $this->registration_time = date('Y-m-d G:i:s e');
        $this->activation = 'false';
    }

    public function getUserName()
    {
        return $this->userName;
    }

    // return user mail
    // 返回用户的电子邮件数据
    public function getUserMail()
    {
        return $this->user_mail;
    }

    public function isError()
    {
        return empty($this->user_mail);
    }

    // 功能 : 输出类变量的值
    // function : The value of the output class variable
    function __toString()
    {    
        return 'user_mail : '  .$this->user_mail.
            'user_password:'.$this->user_password.
            'user_name:'.    $this->user_name.
            'registration_time:'.    $this->registration_time.
            'activation:'.$this->activation;
    }

    // 功能 : 添加一个用户
    // function : Add a user
    static public function addAUser($newUser)
    {
        $arr;
        $rowsName;
        $keys;
        $notFirst = false;
        $feige = ' , ';

        foreach ($newUser as $key => $value) {
            $arr[$key] = $value;
            if (!$notFirst) 
            {
                $notFirst = !$notFirst;
                $feige = ' ';
            }
            else
            {
                $feige = ' , ';
            }
            $keys .= $feige. $key;
            $rowsName .= $feige. ':'.$key;
        }
        $SQL = 'INSERT INTO '.self::$tableName.' ('.$keys.') '.'VALUES( '.$rowsName.' )';
        Database::executeSQL($SQL, $arr);
    }

    // Validation is already registered, if it is returned to true
    // 验证是已经注册用户，如果是返回 true
    public static function repeat($User)
    {
        // run Execute query statement
        $result = self::findUser($User);
        $total = 0;
        foreach ($result as $key => $value) {
            $total ++;
        }
        return $total ? 'true' : 'false';
    }

    // Find user
    // 查找用户
    public static function findUser($User)
    {
        return self::find(Array('user_mail'=> $User->getUserMail()));
    }

    // Find the properties and values that have been stored
    // 查找是否已经存储该信息的属性和值
    private static function find($list)
    {
        $SQL = 'SELECT * FROM '. self::$tableName. ' WHERE ';
        $ArrayList;
        $Delimiter = ' AND ';
        $notFirst = false;

        foreach ($list as $key => $value) {
            $ArrayList[':'. $key] = $value;
            $SQL .= $notFirst ? $Delimiter : '  '. $key. ' = :'. $key. ' ';
            if (!$notFirst)
                $notFirst = true;
        }
        $result = Database::getDB()-> prepare($SQL);;
        $result-> execute($ArrayList);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>