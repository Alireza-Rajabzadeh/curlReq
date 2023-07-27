# curlReq
A simple and easy php class for send curl request

install package using : 

    composer require alirexa/curlreq

init curl with this : 

    $request = new CurlReq();

To set url use setUrl("your_url") : 

    $request->setUrl("example.com/something");

if you your requestis json call data will json encoded and json headers add: 

    $request->json();

add data to request (array,by call json() function data will send json encoded): 

    $request->setData($data);


add your headers by call setHeaders(): 

    $request->setHeaders($your_array_headers);

change your request time out by call setTimeOut() in Second: 

    $request->setTimeOut($Second);

you can trun Exception on or off by call Exception(false or true)
on true exception will throw and on false will not default is false : 

    $request->Exception(false); # exception off
    $request->Exception(true); # exception on

use get,post,put,delete method base on url accepted method : 

    $request->get();
    $request->post();
    $request->put();
    $request->delete();

To get response details of request use below methods : 

    $request->response_httpcode; //get requesthttp code
    $request->response_headers; // get request headers
    $request->response; //get parsed responsed
    $request->curl_result; // get curl raw response
    $request->errors; // get error if exist
    $request->error_number ; get error number if exis

Or you can get all in one array by call responseInArray() ;

    $request->responseInArray;

Let me know if something works wrong by send me an email: Orginalireza@gmail.com

thanks