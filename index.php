<?php
error_reporting(error_reporting() & ~E_NOTICE & ~E_WARNING);

use Interpay\TestApp\TestApp;
require __DIR__ . '/vendor/autoload.php';
$app = new TestApp();

if( isset($_POST['s']) ){
    $app->search();
}else{
    $app->run();
}
?>