<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of api
 *
 * @author João Madeira
 */
class Api
{
    private $idapi;
    private $url;
    private $client;
    private $secret;
    private $token;
    private $endpoint;
    private $auth;
    private $response;

    //put your code here
    function __construct()
    {
        //body
    }

    function getCredentials($scope, $type)
    {
        $con       = new Database();
        $resultado = $con->get("SELECT * FROM api WHERE scope='$scope' AND type='$type'");
        $resultado = $resultado[0];

        $this->idapi    = $resultado['idapi'];
        $this->client   = $resultado['client'];
        $this->secret   = $resultado['secret'];
        $this->token    = $resultado['token'];
        $this->endpoint = $resultado['endpoint'];
        $this->auth     = $resultado['auth'];
        $this->url      = $resultado['url'];
    }

    private function getNewCredentials()
    {
        $request        = $request        = $this->url.$this->auth;
        $headers        = array('Content-Type: application/x-www-form-urlencoded');
        $post           = 'grant_type=client_credentials&client_id='.$this->client.
            '&client_secret='.$this->secret.'&scope=*';
        $curl           = curl_init($request);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result         = curl_exec($curl);
        $this->response = json_decode($result);
        curl_close($curl);
        if (strpos($result, 'access_token') !== false) {
            $con       = new Database();
            $resultado = $con->set("UPDATE api SET token='".$this->response->access_token."' WHERE idapi=".$this->idapi." ");
            $this->getCredentials((PROD ? 'PROD' : 'DEV'), 'escoteiro');
            return true;
        }
        return false;
    }

    private function apiAcesso($request)
    {
        $headers = array('Content-Type: application/json',sprintf('Authorization: Bearer %s', $this->token));
        $curl    = curl_init($request);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result  = curl_exec($curl);
        curl_close($curl);
        if (strpos($result, 'Redirecting') !== false) {
            if (!$this->getNewCredentials()) {
                return false;
            } else {
                return $this->apiAcesso($request);
            }
        } elseif (strpos($result, '404 Not Found') !== false) {
            if (!$this->getNewCredentials()) {
                return false;
            } else {
                return $this->apiAcesso($request);
            }
        }
        $this->response = $result;
        return true;
    }

    public function get($type, $value)
    {
        $this->getCredentials((PROD ? 'PROD' : 'DEV'), $type);
        $request = $this->url.$this->endpoint.$value;
        if ($this->apiAcesso($request)) {
            return json_decode($this->response);
        } else {
            return json_decode('{"success":"false", "message" : "Acesso negado."}');
        }
    }
}

/*$result = json_decode($result);
        curl_close($curl);
        return $result;
         $result  = json_decode($result);
          if (property_exists($result, 'message')) {
          return '{"success":"false", "message" : "'.$result->message.'"}';
          }
          curl_close($curl);
          return $this->mappingEAEP($result);
          } else return '{"success":"false", "message" : "Acesso negado."}'; */