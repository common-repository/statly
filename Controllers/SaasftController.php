<?php
namespace Controllers;

class SaasftController{
    protected $uuid;
    protected $_token;
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->uuid = get_option('saasft_statly_site_uuid');
        $this->_token = get_option('saasft_statly_token');
    }
    public function view($view,$data = []){
        extract($data);
        include_once( SAASFT_PLUGIN_PATH . 'views/'.$view.'.php' );
    }
    
    public function flash($message, $type = 'error'){
        $_SESSION['saasft_statly_messages'][] = array(
            'message' => $message,
            'type'    => $type
        );
    }
    public function flashErrors($messages, $type = 'error'){
        foreach($messages as $msg){
            $_SESSION['saasft_statly_messages'][] = array(
                'message' => $msg,
                'type'    => $type
            );
        }
    }
    
    public function request_statly_data($uri,$data, $method = 'POST'){
        $response_data = false;
        if($method = 'POST'){
            $response = wp_remote_post( SAASFT_StatlyUrl."api/".$uri, array(
                'headers' => array(
                    'Authorization' => 'Bearer ' . $this->_token
                ),
                'timeout'     => 30,
                'body' => $data,
                )
            );
        }else{
            $response = wp_remote_get( SAASFT_StatlyUrl."api/".$uri, array(
                'headers' => array(
                    'Authorization' => 'Bearer ' . $this->_token
                ),
                'timeout'     => 30,
                'body' => $data,
                )
            );
        }
        if ( is_wp_error( $response ) ) {
           $error_message = $response->get_error_message();
           $this->flash($error_message, 'error');
        } else {
            
            $json_response = json_decode($response['body']);
            if($json_response->error === 'token_invalid' || $json_response->error === 'token_not_provided' || $json_response->error === 'token_expired'){
                if($_SESSION['json_response']){
                    unset($_SESSION['json_response']);
                    $error = new \stdClass;
                    $error->error = true;
                    echo json_encode($error);
                    die();
                }else{
                    header("Location: admin.php?page=statly-setting-admin&tab=login");
                }
                
            }else if($json_response->error){
                $this->flashErrors($json_response->messages);
            }else if(json_last_error() == JSON_ERROR_NONE){
                $response_data = $json_response;
            }else{
                $this->flash('Something went wrong. Please try again or contact administrator');
            }
        }
        return $response_data;
    }
}