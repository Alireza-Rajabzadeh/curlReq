<?php
require __DIR__ . '/vendor/autoload.php';

use Curlreq\CurlReq;


$data = array(
    'foo' => 'bar',
    'baz' => 'boom',
    'cow' => 'milk',
    'php' => 'hypertext processor',
);

// echo http_build_query( $data ) . "\n";
// echo http_build_query( $data, '', '&amp;' );

// die();



$x = new CurlReq();

// $x->setUrl("https://httpbin.org/put")->json()->setData($data);
$x->setUrl("https://httpbin.org/delete")->json()->setData($data);
// $x->setUrl("https://httpbin.org/post")->json()->setData($data);
// $x->setUrl("https://httpbin.org/get")->json()->setData($data);
// var_dump($x);
$x->delete();
// $x->sendGet();

var_dump($x->response_headers);
var_dump($x->response);
