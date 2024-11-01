<?php

/*
Plugin Name:        Statly Advanced Analytics and Sales Funnel Tracking
Plugin URI:         https://statly.org/
Description:        Statly Analytics provides cutting edge analytics, sales funnel tracking and patent-pending, AI-based traffic mapping to help you generate more revenue and provide a better user experience for your visitors.  Additionally, you can add UTM variables to every link on your website automatically to track referring posts and pages; both in Statly and other analytics applications.
Version:            1.1
Author:             Statly
Author URI:         https://doneforyou.com/
License:            GPL v2 or higher
License URI:        License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if( ! defined( 'WPINC') )
    die;

require 'settings.php';
define( 'SAASFT_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

//define('SAASFT_StatlyUrl', "http://localhost/statly/public/");
//define('SAASFT_StatlyUrl', "http://intelligently.org/master/statly/public/");
define('SAASFT_StatlyUrl', "https://app.statly.org/");

function saasft_add_utm_variables_to_urls($content) {

    if(get_option('saasft_enable_utm') == "on"){
        $data['pattern'] ='~href=("|\')(.+?)\1~';
        $data['utm_vars'] = 'utm_source='.$_SERVER['HTTP_HOST'].'&utm_medium='.get_post_type().'&utm_campaign='.get_the_title();
        return preg_replace_callback(
            $data['pattern'],
            function ($matches) use($data) {
                $glue = '?';
                if(strpos($matches[0], '?') !== false){
                    $glue = '&';
                }
                return preg_replace($data['pattern'], 'href=$1$2'.$glue.$data['utm_vars'].'$1', $matches[0]);
            },
            $content
        );
    } else {
        return $content;
    }
}
add_filter('the_content', 'saasft_add_utm_variables_to_urls',11);
add_action('wp_head', 'saasft_add_statlyanalytics');
function saasft_add_statlyanalytics() {
if(!empty(get_option('saasft_statly_site_uuid'))){
?>
<!-- Statly Tracking Code -->
<script type="text/javascript">
var jTrack = jTrack || {};
jTrack.key = "<?= get_option('saasft_statly_site_uuid') ?>";
jTrack.collector = "<?= SAASFT_StatlyUrl ?>api";
(function () {
var sf = document.createElement("script"), script = document.getElementsByTagName("script")[0];
sf.type = "text/javascript";
sf.async = true;
sf.src = "<?= SAASFT_StatlyUrl ?>api/js/rii1C.js";
script.parentNode.insertBefore(sf, script);
})();
</script>
<?php 
}
}

function saasft_statly_utm_tracking( $plugin ) {
    if( $plugin == plugin_basename( __FILE__ ) ) {
        delete_option( 'saasft_statly_step' );
        delete_option( 'saasft_statly_site_uuid' );
        delete_option( 'saasft_statly_site_detail' );
        delete_option( 'saasft_statly_user' );
        delete_option( 'saasft_statly_token' );
        exit( wp_redirect( admin_url( 'options-general.php?page=statly-setting-admin' ) ) );
    }
}
add_action( 'activated_plugin', 'saasft_statly_utm_tracking' );

function saasft_add_statly_logo_at_footer() {
        echo '<style>body{margin-bottom: 46px !important;}</style><div style="
    background-color: transparent;
    position : fixed;
    bottom : 0;
    width: 100%;
    z-index: 100;
    text-align: center;
"><a target="_blank" href="https://statly.org/"><img src="https://app.statly.org/external/powered-by-statly.png"/></a></div>';
    
}
if(get_option( 'saasft_enable_logo')){
    add_action( 'wp_footer', 'saasft_add_statly_logo_at_footer', 100 );
}

function saasft_statly_styles(){
    wp_register_style( 'saasft_statly_bootstrap', plugin_dir_url( __FILE__ ).'css/bootstrap.min.css?v=1' );
    wp_register_style( 'saasft_statly_style', plugin_dir_url( __FILE__ ).'css/style.css?v=1' );
    wp_register_style( 'saasft_statly_pickaday', plugin_dir_url( __FILE__ ).'css/pikaday-package.css?v=1' );
    wp_register_style( 'saasft_statly_morris', plugin_dir_url( __FILE__ ).'css/morris.css?v=1' );
	wp_enqueue_style( 'saasft_statly_bootstrap' );   
	wp_enqueue_style( 'saasft_statly_style' );   
	wp_enqueue_style( 'saasft_statly_pickaday' );   
	wp_enqueue_style( 'saasft_statly_morris' );   
}
function saasft_statly_scripts(){
    wp_register_script('saasft_statly_jquery', plugin_dir_url( __FILE__ ).'js/jquery.js',array(), '1.0');
    wp_enqueue_script('saasft_statly_jquery');
    
    wp_register_script('saasft_statly_bootstrapjs', plugin_dir_url( __FILE__ ).'js/bootstrap.min.js',array('saasft_statly_jquery'), '1.0');
    wp_enqueue_script('saasft_statly_bootstrapjs');
    
    wp_register_script('saasft_statly_script', plugin_dir_url( __FILE__ ).'js/statly_script.js?v=1',array('saasft_statly_jquery'), '1.0');
    wp_enqueue_script('saasft_statly_script');
}
function app_output_buffer() {
	ob_start();
}

if(isset($_GET['page']) && ($_GET['page'] == 'statly-setting-admin')){
    add_action('admin_print_styles', 'saasft_statly_styles');  
    add_action('init', 'saasft_statly_scripts');
    add_action('init', 'app_output_buffer');
}

