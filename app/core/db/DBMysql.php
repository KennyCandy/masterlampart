<?php 
namespace App\Core\DB;

use \PDO;

/**
 * This is a class DBMysql inplements DB
 */
class DBMysql implements DB
{
    protected  $db;

    /**
     * connect databse
     *
     * @param  $dsn, $user, $pass info to connect MYSQL DATABASE
     *
     */
    public function connect($dsn='phplampart', $user = '', $pass = '')
    {   
        $this->db = new PDO($dsn, $user, $pass);
    }

    /**
     * run query
     *
     * @return  result
     *
     */
    public function query($query)
    {
        return $this->db->query($query);
    }

    /**
     * run query
     *
     * @return  result
     *
     */
    public function lastInsertId()
    {
        return $this->db->lastInsertId();
    }
}