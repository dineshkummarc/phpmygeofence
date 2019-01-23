<?php
/*
 * Author: Xu Ding
 * website: www.startutorial.com
 *          www.the-di-lab.com
 */
class Polygon
{
    static $_dbHost     = 'localhost'; 
    static $_dbName     = 'polygon';   
    static $_dbUserName = 'root';  
    static $_dbUserPwd  = '';
     
    // get coordinates
    static public function getCoords()
    {
        return self::get();
    }
     
    // save coordinates
    static public function saveCoords($rawData)
    {
        self::save($rawData);
    }
     
    // save lat/lng to database
    static public function save ($data)
    {
        $con = mysql_connect(self::$_dbHost, self::$_dbUserName, self::$_dbUserPwd);
         
        // connect to database
        if (!$con) {
            die('Could not connect: ' . mysql_error());
        }
         
        mysql_select_db(self::$_dbName, $con);
         
        // delete old data
        mysql_query("DELETE FROM points");
         
        // insert data
        mysql_query("INSERT INTO points (data) VALUES ($data)");
         
        // close connection
        mysql_close($con);
    }  
     
    // get lat/lng from database
    static private function get()
    {  
        $con = mysql_connect(self::$_dbHost, self::$_dbUserName, self::$_dbUserPwd);
         
        // connect to database
        if (!$con) {
            die('Could not connect: ' . mysql_error());
        }
         
        mysql_select_db(self::$_dbName, $con);
         
        $result = mysql_query("SELECT * FROM points");
                 
        $data   = false;
         
        while($row = mysql_fetch_array($result,MYSQL_ASSOC))
        {
            $data = $row['data'];
        }
         
        // close connection
        mysql_close($con);     
         
        return $data;
    }
     
}