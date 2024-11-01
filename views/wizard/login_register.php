<?php
include 'header.php';
$statly_email = get_option('admin_email');
if (get_option('saasft_statly_user')['email']) {
    $statly_email = get_option('saasft_statly_user')['email'];
}
$statly_first_name = '';
if (get_option('saasft_statly_user')['first_name']) {
    $statly_email = get_option('saasft_statly_user')['first_name'];
}
$statly_last_name = '';
if (get_option('saasft_statly_user')['last_name']) {
    $statly_email = get_option('saasft_statly_user')['last_name'];
}
?>
    <div class="col-sm-6">
        <h2 class="text-center margin-top-0"> 
            <?= $_GET['tab'] == 'login'? 'Session expired, Login again' : 'Login' ?>
        </h2>
        <div class="loginform">
            <form method="post" action="admin.php">
                <div class="statlylogo">
                    <img src="<?= plugin_dir_url(__FILE__) . '../../img/logo.png' ?>" alt="statlylogo">
                </div>
                <?php
                settings_fields('statly_og_login');
                ?>
                <input type="hidden" name="tokenexpired" value="<?= $_GET['tab'] ?>">
                <div class="form-group">
                    <input required="required" type="email" id="email" class="form-control" name="saasft_statly_user[email]" value="<?= $statly_email ?>" placeholder="Email Address">
                </div>
                <div class="form-group">
                    <input required="required" type="password" id="password" class="form-control" name="saasft_statly_user[password]" value="" placeholder="Password">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" id="submit" class="btn submit-btn btn-primary btn-block" value="LOGIN">
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <a href="https://app.statly.org/auth/forgot" target="_blank">Forgot password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="wrapper">
            <div class="line"></div>
            <div class="wordwrapper">
                <div class="word">or</div>
            </div>
        </div>
        <h2 class="text-center margin-top-0"> Sign Up Free</h2>
        <div class="signupform">                
            <form method="post" action="admin.php">
                <div class="statlylogo">
                    <img src="<?= plugin_dir_url(__FILE__) . '../../img/statly-logo-light.png' ?>" alt="statlylogo">
                </div>
                <input type="hidden" name="option_page" value="statly_og_register">
                <input type="hidden" name="action" value="update">
                <input type="hidden" id="_wpnonce2" name="_wpnonce" value="<?= wp_create_nonce() ?>">
                <input type="hidden" name="_wp_http_referer" value="<?= wp_get_referer() ?>">
                <div class="form-group">
                    <input required="required" type="text" id="signup-firstname" class="form-control" name="saasft_statly_user[firstname]" value="" placeholder="First Name">
                </div>
                <div class="form-group">
                    <input required="required" type="text" id="signup-lastname" class="form-control" name="saasft_statly_user[lastname]" value="" placeholder="Last Name">
                </div>
                <div class="form-group">
                    <input required="required" type="email" id="signup-email" class="form-control" name="saasft_statly_user[email]" value="" placeholder="Email">
                </div>
                <div class="form-group">
                    <input required="required" type="password" id="signup-password" class="form-control" name="saasft_statly_user[password]" value="" placeholder="Password">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" id="signup-submit" class="btn submit-btn btn-default btn-block" value="SIGN UP">
                </div>
            </form>
        </div>
    </div>
<?php
include 'footer.php';
?>