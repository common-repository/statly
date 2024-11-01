<?php
namespace Controllers;
include_once 'SaasftController.php';
use Controllers\SaasftController;
class SaasftAccountSettingsController extends SaasftController{
    public function getAccountSettingsPage(){
        $this->view('account_settings');
    }
    
    public function updateAccountSettings(){
        $enable_logo = $_POST['saasft_enable_logo'];
        update_option('saasft_enable_logo',$enable_logo);
        $this->flash('Account settings updated successfully','success');
        header("Location: admin.php?page=statly-setting-admin&tab=account-settings");
    }
}