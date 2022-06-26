<?php

namespace Interpay\Utils;

class Writer
{
    public function addBooksToDatabase($data){
        $db = new Db();
        foreach($data as $v){
            $db->query("INSERT IGNORE INTO authors(`name`) VALUES(?)",
                        array($v['author']));
            $author_id = $db->getDb()->lastInsertId();
            if( !$author_id ){
                $author_id = $db->select("SELECT * FROM authors WHERE name = ?", array($v['author']), true)['id'];
            }
            if( $author_id ){
                $db->query("INSERT IGNORE INTO books(`name`, `author_id`) VALUES(?,?)",
                    array($v['name'], $author_id));
            }
        }
    }
}