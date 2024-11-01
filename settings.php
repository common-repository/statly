<?php
include 'Controllers/SaasftWizardController.php';
include 'Controllers/SaasftAccountSettingsController.php';
include 'Controllers/SaasftLinksController.php';
include 'Controllers/SaasftDashboardController.php';
use Controllers\SaasftWizardController;
use Controllers\SaasftAccountSettingsController;
use Controllers\SaasftLinksController;
use Controllers\SaasftDashboardController;

class Saasft_SettingsPage
{
   
    private $wizard;
    private $accountSettings;
    private $links;
    private $dashboard;
    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
        $this->wizard = new SaasftWizardController();
        $this->accountSettings = new SaasftAccountSettingsController();
        $this->links = new SaasftLinksController();
        $this->dashboard = new SaasftDashboardController();
        add_action("wp_ajax_saasft_statly_live_stats", array( $this->dashboard, 'getLiveStats' ));
        
    }
    
    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be in "main menu"
        add_menu_page(
            'Settings Admin', 
            'Statly Analytics',
            'manage_options', 
            'statly-setting-admin',
            array( $this, 'create_admin_page' )
        );
    
    }



    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        if(!empty( $_GET[ 'step' ] )){
            update_option('saasft_statly_step',$_GET[ 'step' ]);
            if($_GET[ 'step' ] == 1){
                delete_option( 'saasft_statly_step' );
                delete_option( 'saasft_statly_site_uuid' );
                delete_option( 'saasft_statly_site_detail' );
                delete_option( 'saasft_statly_user' );
                delete_option( 'saasft_statly_token' );
                delete_option( 'saasft_enable_utm' );
                delete_option( 'saasft_enable_logo' );
            }
            header("Location: admin.php?page=statly-setting-admin");
        }
        $saasft_statly_step = get_option('saasft_statly_step');
        $active_tab = !empty( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : get_option('saasft_statly_tab');
                                
                        if($saasft_statly_step == 5 && $active_tab != 'login'){
                            if($active_tab == 'events'){
                                $this->wizard->getEvents();
                            }
                            else if($active_tab == 'account-settings'){
                                $this->accountSettings->getAccountSettingsPage();
                            }
                            else if($active_tab == 'links'){
                                $this->links->getLinksPage();
                            }
//                            else 
//                            if($active_tab == 'conversions'){
//                                echo '<a href="?page=statly-setting-admin&tab=conversions" class="nav-tab'. $active_tab == 'conversions' ? "nav-tab-active" : "".'">Conversions</a>';
//                            }else if($active_tab == 'monitoring'){
//                                echo '<a href="?page=statly-setting-admin&tab=monitoring" class="nav-tab'. $active_tab == 'monitoring' ? "nav-tab-active" : "".'">Monitoring</a>';
//                            }
                            else{
                                $this->dashboard->getDashboardPage();
                            }
                        }else if($active_tab != 'login') {
                            if($saasft_statly_step == 4){
                                $this->wizard->getCompletionPage();
                            }else if($saasft_statly_step == 3){
                                $this->wizard->getEvents();
                            }else if($saasft_statly_step == 2){
                                $this->wizard->getSites();
                            }else{
                                $this->wizard->loginRegister();
                            }
                        }else{
                            $this->wizard->loginRegister();
                        }
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if($_POST['option_page'] == 'statly_og_register'){
                $this->wizard->registerPost();                              
            }else if($_POST['option_page'] == 'statly_og_login'){
                $this->wizard->loginPost();                              
            }else if($_POST['option_page'] == 'statly_og_sites'){
                $this->wizard->addExistingSite();                              
            }else if($_POST['option_page'] == 'statly_og_new_site'){
                $this->wizard->addNewSite();                              
            }else if($_POST['option_page'] == 'statly_events_settings'){
                $this->wizard->createEvent();                              
            }else if($_POST['option_page'] == 'statly_account_settings'){
                $this->accountSettings->updateAccountSettings();                             
            }else if($_POST['option_page'] == 'statly_links'){
                $this->links->updateLinks();                              
            }
        }
    }
}

if( is_admin() )
    $saasft_settings_page = new Saasft_SettingsPage();