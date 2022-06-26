<?php

namespace Interpay\Utils;

class Reader
{
    protected $path = 'catalog';

    public function getBooksData(){
        $xmlFiles = array();
        $this->getXmlFiles($this->path, $xmlFiles);
        $data = $this->readBooksFromFiles($xmlFiles);
        return $data;
    }

    protected function readBooksFromFiles($data){
        $booksData = array();
        foreach($data as $v){
            if( is_file($v) ){
                try {
                    $books = simplexml_load_file($v);

                    echo '<pre>' , htmlspecialchars(file_get_contents($v)) , '<pre>';
                    foreach ($books as $book) {
                        $booksData[] = array(
                            "name" => $book->name,
                            "author" => $book->author
                        );
                    }
                }catch (Exception $exception){
                    echo 'Wrong XML or no data!';
                }
            }
        }
        return $booksData;
    }

    protected function getXmlFiles($dir, &$results){
        $files = glob($dir.'/*');
        foreach ($files as $key => $value) {

            $path = $value;
            if (!is_dir($path)) {
                $parts = pathinfo($path);
                if( $parts['extension'] == 'xml' ){
                    $results[] = $path;
                }
            } else if ($value != "." && $value != "..") {
                $this->getXmlFiles($path, $results);
            }
        }

        return $results;
    }
}