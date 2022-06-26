<?php

namespace Interpay\Utils;
use PDO;

class Db
{
    protected $db;

    public function __construct()
    {
        $host = '127.0.0.1';
        $db   = 'interpay';
        $user = 'root';
        $pass = '';
        $charset = 'utf8';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        try {
            $this->db = new PDO($dsn, $user, $pass, $opt);
        } catch (PDOException $e) {
            die('No connection: ' . $e->getMessage());
        }
    }


    public function getDb()
    {
        return $this->db;
    }


    public function query($sql, $data = array())
    {
        $db = $this->getDb();
        $stmt = $db->prepare($sql);
        $stmt->execute($data);
        return $stmt;
    }

    public function select($sql, $data = array(), $one=false)
    {
        $res = $this->query($sql, $data);
        if( $one )
            return $res->fetch();
        else
            return $res->fetchAll();
    }

}