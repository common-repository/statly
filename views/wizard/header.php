    <div class="content-row">
        <a href="http://app.statly.org"><img src="<?= plugin_dir_url(__FILE__) . '../../img/logo.png' ?>" alt="statlylogo" class="statlybrand"></a>
        <!-- <a target="_blank" href="https://statly.org/upgrade" class="btn btn-success upgradebtn">Upgrade Now</a> -->
        <a href="mailto:support@statly.org"><img src="http://res.cloudinary.com/heliumup/image/upload/v1533834003/support.png" alt="statlylogo" class="supportimg"></a>
    </div>
<div class="col-xs-12">
    <?php if (isset($_SESSION['saasft_statly_messages'])) { ?>

        <div class="wrap">
            <?php
            foreach ($_SESSION['saasft_statly_messages'] as $msg) {
                ?>
                <div class="notice notice-<?= $msg['type'] ?> is-dismissible">
                    <p><?= $msg['message'] ?></p>
                    <button type="button" class="notice-dismiss">
                        <span class="screen-reader-text">Dismiss this notice.</span>
                    </button>
                </div>


                <?php
            }
            unset($_SESSION['saasft_statly_messages']);
            ?>
        </div>
    <?php
    }

    $active_tab = !empty($_GET['tab']) ? $_GET['tab'] : get_option('saasft_statly_tab');
    $saasft_curr_step = get_option('saasft_statly_step');
    ?>
    <div class="nav-tab-wrapper">
        <?php
        if ($saasft_curr_step == 5) {
            ?>
            <a href="?page=statly-setting-admin" class="nav-tab <?= $active_tab == 'dashboard' || ($saasft_curr_step == 5 && empty($active_tab)) ? "nav-tab-active" : "" ?>">Dashboard</a>
            <a href="?page=statly-setting-admin&tab=account-settings" class="nav-tab <?= $active_tab == 'account-settings' ? "nav-tab-active" : "" ?>">Account Settings</a>
            <a href="?page=statly-setting-admin&tab=events" class="nav-tab <?= $active_tab == 'events' ? "nav-tab-active" : "" ?>">Mapping Events</a>
            <a href="?page=statly-setting-admin&tab=links" class="nav-tab <?= $active_tab == 'links' ? "nav-tab-active" : "" ?>">Links</a>

            <a target="_blank" href="https://app.statly.org" class="nav-tab comingsoon <?= $active_tab == 'conversions' ? "nav-tab-active" : "" ?>">Login to Dashboard</a>
            <a target="_blank" href="https://statly.org/upgrade/" class="nav-tab comingsoon <?= $active_tab == 'conversions' ? "nav-tab-active" : "" ?>">Upgrade Now</a>            

            <?php
        } else {
            ?>
            <a href="?page=statly-setting-admin" class="nav-tab nav-tab-active">Setup Wizard</a>
            <?php
        }
        ?>
    </div>
    
    <div class="saasftwrapper">
    <?php if ($saasft_curr_step != 5) { ?>
        <div>
            <ul class="progress-indicator">
                <li class="completed">
                    <span class="bubble"></span>
                </li>
                <li class="<?= $saasft_curr_step == 2 || $saasft_curr_step == 3 || $saasft_curr_step == 4 ? 'completed' : '' ?>">
                    <span class="bubble"></span>
                </li>
                <li class="<?= $saasft_curr_step == 3 || $saasft_curr_step == 4 ? 'completed' : '' ?>">
                    <span class="bubble"></span>
                </li>
                <li class="<?= $saasft_curr_step == 4 ? 'completed' : '' ?>">
                    <span class="bubble"></span>
                </li>
            </ul>
        </div>
    <?php } ?>

