# curlReq

A simple and easy php class for send curl request

install package using :

    composer require alirexa/curlreq

init curl with this :

    $request = new CurlReq();

    $request->setUrl("example.com/something");

    $request->json(); //data will json encoded and json headers add

    $request->setData($data); //add data in array

    $request->setHeaders($your_array_headers); // set  headers

    $request->setTimeOut($Second); //request timeout

you can trun Exception on or off by call Exception(false or true)
on true exception will throw and on false will not default is false :

    $request->Exception(false); # exception off
    $request->Exception(true); # exception on

use get,post,put,delete method base on url accepted method :
    $request->get();
    $request->post();
    $request->put();
    $request->delete();

Response detail :
    $request->response_httpcode; //get request http code
    $request->response_headers; // get request headers
    $request->response; //get parsed responsed
    $request->curl_result; // get curl raw response
    $request->errors; // get error if exist
    $request->error_number ; get error number if exis

Or you can get all in one array by call responseInArray() ;
    $request->responseInArray();
Let me know if something works wrong by send me an email: Orginalireza@gmail.com

thanks
