<?php

namespace Curlreq;

use Exception;

class CurlReq
{
    protected $curl_handler;
    protected $url;
    protected $request_headers = [];
    protected $request_data = [];
    protected $post_fields;
    protected $query_params;
    protected $curl_timeout = 60;
    protected $curl_result;
    public $CurlResp;
    public $response;
    public $response_headers;
    public $response_content;
    public $response_httpcode;
    public $error_number;
    public $errors;
    protected $Exception;
    protected $is_json;

    protected $token;

    public function __construct()
    {
        $this->requestInit();
    }

    private function requestInit()
    {
        $this->curl_handler = curl_init();
        curl_setopt($this->curl_handler, CURLOPT_HEADER, true);
        curl_setopt($this->curl_handler, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->curl_handler, CURLOPT_TIMEOUT, $this->curl_timeout);
    }

    public function setUrl(string $url)
    {
        $this->url = $url;
        return $this;
    }
    public function setDefaultHeaders()
    {
    }

    public function Exception(bool $exeption_status)
    {
        $this->Exception = $exeption_status;
        return $this;
    }


    public function setHeaders(array $headers)
    {
        $this->request_headers = array_merge($this->request_headers, $headers);
        return $this;
    }
    public function setTimeOut(int $Second)
    {
        $this->curl_timeout = $Second;
        curl_setopt($this->curl_handler, CURLOPT_TIMEOUT, $this->curl_timeout);
        return $this;
    }
    public function setData(array $data)
    {
        $this->request_data = array_merge($this->request_data, $data);
        return $this;
    }

    public function json()
    {
        $json_request_default_headers = [
            "Content-Type" => "application/json",
            "Accept" => "application/json",
        ];

        $this->setHeaders($json_request_default_headers);

        $this->is_json = true;
        return $this;
    }

    public function post()
    {
        curl_setopt(
            $this->curl_handler,
            CURLOPT_POST,
            true
        );

        return $this->excuteRequest();
    }
    public function get()
    {
        $this->query_params = http_build_query($this->request_data);
        $this->url = $this->url . "?" . $this->query_params;

        return $this->excuteRequest();
    }

    public function put()
    {
        curl_setopt(
            $this->curl_handler,
            CURLOPT_CUSTOMREQUEST,
            "PUT"
        );

        return $this->excuteRequest();
    }

    public function delete()
    {
        curl_setopt(
            $this->curl_handler,
            CURLOPT_CUSTOMREQUEST,
            "DELETE"
        );

        return $this->excuteRequest();
    }

    public function excuteRequest()
    {
        curl_setopt($this->curl_handler, CURLOPT_URL, $this->url);
        curl_setopt(
            $this->curl_handler,
            CURLOPT_HTTPHEADER,
            $this->request_headers
        );

        $this->post_fields = $this->is_json ? json_encode($this->request_data) : $this->request_data;
        curl_setopt(
            $this->curl_handler,
            CURLOPT_POSTFIELDS,
            $this->post_fields
        );

        $this->curl_result = curl_exec($this->curl_handler);
        curl_close($this->curl_handler);
        $this->parseResponse();
        return $this;
    }

    private function parseResponse()
    {
        $this->errors = curl_error($this->curl_handler);
        $this->error_number = curl_errno($this->curl_handler);

        if (!$this->curl_result && $this->Exception) {
            $exp_msg = "Error number : " . $this->error_number . " | " . $this->errors;
            throw new Exception($exp_msg, 1);
        }

        $this->response_httpcode = curl_getinfo($this->curl_handler, CURLINFO_HTTP_CODE);

        $header_size = curl_getinfo($this->curl_handler, CURLINFO_HEADER_SIZE);
        $this->response_headers = substr($this->curl_result, 0, $header_size);
        $this->response = substr($this->curl_result, $header_size);
        return $this;
    }

    function responseInArray()  {

        return [
            "http_code"=>$this->response_httpcode,
            "headers"=>$this->response_headers,
            "response" => $this->response,
            "raw_response" => $this->curl_result,
            "errors" => $this->errors,
            "error_number" => $this->error_number,
            
        ];
        
    }
}
