<?php

namespace Interpay\TestApp;

use Interpay\Utils\Reader;
use Interpay\Utils\Search;
use Interpay\Utils\Writer;

class TestApp
{
    public function __construct(){

    }

    public function run(){
        $reader = new Reader();
        $writer = new Writer();
        $booksData = $reader->getBooksData();
        //var_dump($booksData);
        $writer->addBooksToDatabase($booksData);
    }

    public function search(){
        $search = new Search();
        echo json_encode($search->searchAuthor());
    }
}