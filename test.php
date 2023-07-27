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


#init curl with this : 
$request = new CurlReq();
# To set url use setUrl("your_url") : 
$request->setUrl("https://httpbin.org/post");

#if you your requestis json call data will json encoded and json headers add: 
$request->json();

#add data to request (array,by call json() function data will send json encoded): 
$request->setData($data);









// $x->setUrl("https://httpbin.org/post")->json()->setData($data);
// $x->setUrl("https://httpbin.org/get")->json()->setData($data);
// var_dump($x);
$request->post();
// $x->sendGet();

// var_dump($x->response_headers);
var_dump($request->responseInArray());
