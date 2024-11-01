<?php
namespace Controllers;
include_once 'SaasftController.php';
use Controllers\SaasftController;
class SaasftWizardController extends SaasftController{
    public function loginRegister(){
        
        $this->view('wizard/login_register');
        
    }
    public function registerPost(){
        $input = $_POST['saasft_statly_user'];
        $errors = false;
        if(empty($input['firstname'])){
            $this->flash("Please Enter Statly First Name", 'error');
            $errors = true;
        }
        if(empty($input['lastname'])){
            $this->flash("Please Enter Statly Last Name", 'error');
            $errors = true;
        }
        if(empty($input['email'])){
            $this->flash("Please Enter Statly Email", 'error');
            $errors = true;
        }
        if(empty($input['password'])){
            $this->flash("Please Enter Statly Password", 'error');
            $errors = true;
        }
        if(!$errors){
            update_option('saasft_statly_step',1);
            $json_response = $this->request_statly_data("user/register",$input);
            if($json_response){
                if(!empty($json_response->token)){
                    update_option('saasft_statly_token',$json_response->token);
                    unset($input['password']);
                    update_option('saasft_statly_user',$input);
                    update_option('saasft_statly_step',2);
                    $this->_token = $json_response->token;
                    $this->flash('Registered successfully.','success');
                    $this->flash('Please check your email to validate your account before logging in.','warning');
                }
            }
        }
        header("Location: admin.php?page=statly-setting-admin");
    }
    public function loginPost(){
        $input = $_POST['saasft_statly_user'];
        $errors = false;
        if(empty($input['email'])){
            $this->flash("Please Enter Statly Email", 'error');
            $errors = true;
        }
        if(empty($input['password'])){
            $this->flash("Please Enter Statly Password", 'error');
            $errors = true;
        }
        if(!$errors){
            $statly_email = '';
            if (get_option('saasft_statly_user')['email']) {
                $statly_email = get_option('saasft_statly_user')['email'];
            }
            $data = array( 'email' => $input['email'], 'password' => $input['password'] );
            $json_response = $this->request_statly_data("user/login",$data);
            if($json_response){
                if(!empty($json_response->token)){
                    $input['firstname'] = $json_response->firstname;
                    $input['lastname'] = $json_response->lastname;
                    unset($input['password']);
                    update_option('saasft_statly_token',$json_response->token);
                    update_option('saasft_statly_user',$input);
                    if($_POST['tokenexpired'] != 'login' || $statly_email != $input['email']){
                        update_option('saasft_statly_step',2);
                    }
                    $this->_token = $json_response->token;
                    $this->flash('Logged in','success');
                }
            }
        }
        header("Location: admin.php?page=statly-setting-admin");
    }
    public function getSites(){
        
        $json_response = $this->request_statly_data("user/sites",array(),'GET');
        $sites = [];
        $sites_exist = false;
        if($json_response){
            if(count($json_response->sites) > 0){
                $sites = $json_response->sites;
                $sites_exist = true;
            }
        }
        $this->view('wizard/sites',[ 'sites' => $sites, 'sites_exist' => $sites_exist]);
    }
    public function addExistingSite(){
        $_POST      = array_map( 'stripslashes_deep', $_POST );
        $site = ($_POST['saasft_statly_on_sites']);
        $site_decoded = json_decode($site);
        update_option('saasft_statly_site_uuid', $site_decoded->uuid);
        update_option('saasft_statly_site_detail', $site);
        update_option('saasft_statly_step',3);
        update_option('saasft_enable_utm',"on");
        header("Location: admin.php?page=statly-setting-admin");            
    }
    public function addNewSite(){
        $site_data = $_POST['saasft_statly_o_n_new_site'];
        $json_response = $this->request_statly_data("site/create",$site_data);
        
        if($json_response->error === false && isset($json_response->site->uuid)){
            //print_r(json_encode($json_response->site));exit;
            update_option('saasft_statly_site_uuid', $json_response->site->uuid);
            update_option('saasft_statly_site_detail', json_encode($json_response->site));
            update_option('saasft_statly_step',3);
            update_option('saasft_enable_utm',"on");
            $this->flash('Site created successsfully','success');
        }else{
            $this->flash('Site could not be created, please try again or contact administrator','error');
        }
            
        header("Location: admin.php?page=statly-setting-admin");
    }

    public function getEvents(){
        if(!empty($_GET['event_id'])){
            $json_response = $this->request_statly_data("event/".$this->uuid."/delete/".$_GET['event_id'],array());
            if($json_response->error === false)
                $this->flash('Event deleted successsfully','success');
            header("Location: admin.php?page=statly-setting-admin&tab=events");
        }
        
        $json_response = $this->request_statly_data("events/".$this->uuid."/categories",array());
        $this->view('wizard/events_settings',[ 'categories' => $json_response]);          
    }
    public function createEvent(){
        $event_data = $_POST['saasft_statly_event'];
        if($event_data['is_goal'] == "on")
            $event_data['is_goal'] = 1;
        $json_response = $this->request_statly_data("event/".$this->uuid."/create",$event_data);
        if($json_response->error === false)
            $this->flash('Event created successsfully','success');
        header("Location: admin.php?page=statly-setting-admin&tab=events");
    }
    public function getCompletionPage(){
        $this->view('wizard/completion_page');
    }

    public function getPasswordMsg(){
        return ' (We do not save this password in wordpress.)';
    }
}