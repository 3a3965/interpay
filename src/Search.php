<?php

namespace Interpay\Utils;

class Search
{
    protected $db;

    public function __construct(){
        $this->db = new Db();
    }

    public function searchAuthor(){
        return $_POST['s'] ?
               $this->db->select(" SELECT 
                                   a.name aname, b.name bname
                                   FROM authors a
                                   LEFT OUTER JOIN books b ON b.author_id = a.id
                                   WHERE a.name LIKE ?
                                   ORDER BY a.name, b.name
                                   ", array("%".$_POST['s']."%"))
            : array();
    }
}