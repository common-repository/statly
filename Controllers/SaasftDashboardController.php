<?php
namespace Controllers;
include_once 'SaasftController.php';
use Controllers\SaasftController;
class SaasftDashboardController extends SaasftController{
    public function getDashboardPage(){
        $date_start = date('Y-m-d',  strtotime('-1 month'));
        $date_end = date("Y-m-d");
        if(isset($_GET['date_start'])){
            $date_start = $_GET['date_start'];
        }
        if(isset($_GET['date_end'])){
            $date_end = $_GET['date_end'];
        }
        $json_response = $this->request_statly_data("graph/".$this->uuid."/dashboard",array(
            'start' => $date_start,
            'end' => $date_end
        ));
        $daily = [];
        $weekly = [];
        $monthly = [];
        if($json_response->error == false){
            $daily = $json_response->daily;
            $weekly = $json_response->weekly;
            $monthly = $json_response->monthly;
        }
        $json_response = $this->request_statly_data("stats/".$this->uuid."/other",array(
            'start' => $date_start,
            'end' => $date_end
        ));
        $new_visitors = 0;
        $existing_visitors = 0;
        $site_ranking = 0;
        $bottlenecks = 0;
        $opportunities = 0;
        if($json_response->error == false){
            $new_visitors = $json_response->new_visitors;
            $existing_visitors = $json_response->existing_visitors;
            $site_ranking = $json_response->site_ranking;
            $bottlenecks = $json_response->bottlenecks;
            $opportunities = $json_response->opportunities;
        
        }
        $this->view('dashboard',[ 
            'daily' => $daily,
            'weekly' => $weekly,
            'monthly' => $monthly,
            'date_start' => $date_start,
            'date_end' => $date_end,
            'new_visitors' => $new_visitors,
            'existing_visitors' => $existing_visitors,
            'site_ranking' => $site_ranking,
            'bottlenecks' => $bottlenecks,
            'opportunities' => $opportunities,
        ]);
    }
    
    
    public function getLiveStats(){
        $_SESSION['json_response'] = true;
        $json_response = $this->request_statly_data("stats/".$this->uuid."/today",array(),'GET');
        echo json_encode($json_response);
        die();
        
    }
}