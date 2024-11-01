<?php
include 'header.php';
$statly_site_uuid = null;
if (get_option('saasft_statly_site_uuid')) {
    $statly_site_uuid = get_option('saasft_statly_site_uuid');
}
$firstname = "";
if (get_option('saasft_statly_user')['firstname']){
    $firstname = get_option('saasft_statly_user')['firstname'];
}         
$statly_site_name = get_bloginfo('name');
$statly_site_url = get_bloginfo('url');
$timezones = timezone_identifiers_list();
?>
<div class="content-section">
<?php
    if(!empty($firstname)){
    if ($sites_exist) {
        ?>
        <h3 class="wizard-heading">Welcome back <?= $firstname ?>!</h3>
    <?php } else { ?>
        <h3 class="wizard-heading">Welcome to Statly <?= $firstname ?></h3>
    <?php } 
    } ?>
    <form method="post" action="admin.php" onsubmit="ShowLoading()">
        <?php if ($_GET['tab'] == "newsite" || !$sites_exist) { ?>
        <div class="newsiteform">
            
                <?php
                settings_fields('statly_og_new_site');
                ?>
                <div class="form-group">
                    <label for="email">Statly Site Name:</label>
                    <input required="required" type="text" id="statly_site_name" class="form-control" name="saasft_statly_o_n_new_site[site_name]" value="<?= $statly_site_name ?>" />
                </div>
                <div class="form-group">
                    <label for="email">Statly Site URL:</label>
                    <input required="required" type="text" id="statly_site_url" class="form-control" name="saasft_statly_o_n_new_site[site_url]" value="<?= $statly_site_url ?>" /> (Please update http/https)
                </div>
                <div class="form-group">
                    <label for="email">Statly Timezone:</label>
                    <?php
                            printf("<select required='required'  id='timezone' class='form-control' name='saasft_statly_o_n_new_site[site_timezone]'>");
                            foreach ($timezones as $timezone) {
                                printf("<option value='$timezone'>$timezone</option>");
                            }
                            printf("</select>");
                            ?>
                </div>
        </div>
        <?php } else { ?>
            <div class="col-sm-6">
                <div class="site-section">
                    <?php
                    settings_fields('statly_og_sites');
                    ?>
                    <h3 for="saasft_statly_sites">Connect to existing site?</h3>
                    <select id="saasft_statly_sites" name="saasft_statly_on_sites" class="form-control  input-lg" placeholder="Select a site">
                        <?php
                        foreach ($sites as $item) {
                            $selected = ($statly_site_uuid == $item->uuid) ? 'selected="selected"' : '';
                            echo "<option value='" . json_encode($item) . "' $selected>$item->name</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="site-section">
                    <h3 for="saasft_statly_sites">Connect to existing site?</h3>
                    <a href="?page=statly-setting-admin&tab=newsite" class="btn btn-primary btn-lg btn-block">New Site</a>
                </div>

            </div>
        <?php } ?>
        <div class="action-btns col-sm-12">
            <div class="col-xs-6">
                <a href="<?= $_GET['tab'] == "newsite" ? '?page=statly-setting-admin' : '?page=statly-setting-admin&step=1' ?>">
                    <button type="button" class="btn btn-primary btn-circle btn-lg"><i class="glyphicon glyphicon-chevron-left"></i></button>
                </a>
            </div>
            <div class="col-xs-6">
                <button type="submit" name="submit" id="submit" class="btn btn-primary btn-circle btn-lg show-loading"><i class="glyphicon glyphicon-chevron-right"></i></button>
            </div>
        </div>
    </form>
</div>
<div class="loading-section">
    <ul class="loading-points">
        <li><img src="<?= plugin_dir_url(__FILE__) . '../../img/loading.gif' ?>"/></li>
        <li>Adding Tracking code</li>
        <li>Appending UTM variables</li>
        <li>Building Account</li>
    </ul>
</div>
<?php
include 'footer.php';
?>