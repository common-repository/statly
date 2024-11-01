<?php
namespace Controllers;
include_once 'SaasftController.php';
use Controllers\SaasftController;
class SaasftLinksController extends SaasftController{
    public function getLinksPage(){
        $this->view('links');
    }
    
    public function updateLinks(){
        $enable_utm = $_POST['saasft_enable_utm'];
        update_option('saasft_enable_utm',$enable_utm);
        $this->flash('Links settings updated successfully','success');
        header("Location: admin.php?page=statly-setting-admin&tab=links");
    }
}