<?php
include 'wizard/header.php';
$selected = "";
if(get_option( 'saasft_enable_logo' )){
    $selected = "checked";
}
$statly_user = get_option( 'saasft_statly_user' );
$statly_site = json_decode(get_option( 'saasft_statly_site_detail' ));
?>
<div class="col-sm-8">
    <label>User Information </label>
    <div class="form-section-content">
        <div>
            <input type="text" id="fname" name="firstname" placeholder="Your name.." readonly value="Primary Account Holder: <?= $statly_user['email'] ?>">
        </div>
        <p>Grant more users access to view website analytics, live feeds, bottlenecks and conversions instantly by clicking <a href="https://app.statly.org"> HERE</a></p>
    </div>


    
    
    <label>Site Information </label>
    <div class="form-section-content">
        <div class="form-group">
            <div>
                <input type="text" id="fname" name="firstname" placeholder="Your name.." readonly value="Website Name: <?= $statly_site->name ?>">
            </div>
        </div>
        <div class="form-group">
            <div>
                <input type="text" id="fname" name="firstname" placeholder="Your name.." readonly value="Website URL: <?= $statly_site->url ?>">
            </div>
        </div>
        <div class="form-group">
            <div>
                <input type="text" id="fname" name="firstname" placeholder="Your name.." readonly value="Business Time Zone: <?= $statly_site->timezone ?>">
            </div>
            <p>Do you have more than one website? See all sites information, traffic, and your global reach by adding more sites to your account<a href="https://app.statly.org"> FREE</a></p>
        </div>
    </div>
    <form method="post" action="admin.php">
        <?php
        settings_fields('statly_account_settings');
        ?>
        <label><strong>Tracking Confidence<strong> <span class="recommended">(recommended)</span> </label>
        <div class="form-section-content">
            
            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input type="hidden" name="saasft_enable_logo" value="0">
                        <input type="checkbox"  id="enable_logo" name="saasft_enable_logo" <?= $selected ?>>
                        Enable "Powered by Statly" badge below the footer section so you get paid on all referrals you send!
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            <input type="submit" name="submit" id="submit" class="btn submit-btn btn-primary pull-right" value="Save">
        </div>
    </form>
</div>
<div class="col-sm-4">
    <div class="knowledge-card">
        <div class="knowledge-card-container">
            <div class="form-section-heading">Statistically Proven Tips for Increasing conversions</div> 
            <img src="http://res.cloudinary.com/heliumup/image/upload/v1533857417/2018-08-09_17-30-01.png" alt="conversions" class="reverseconversion">
             <p class="form-section-subheading">
                 <strong>1. Track your sources:</strong> Understanding where your traffic is coming from, what they are looking for, and what is critical to increased conversion.
            </p> 
            <img src="http://res.cloudinary.com/heliumup/image/upload/v1533857721/2018-08-09_17-35-07.png" alt="conversions" class="reverseconversion">
            <p class="form-section-subheading">
                <strong> 2. Track who your source is:</strong>Understanding who you're marketing to will help you specifically craft campaigns, posts,  and marketing material to reach to maximum conversion.
            </p>

            <p class="form-section-subheading">
                <strong> 3. Identify your bottlenecks and opportunities:</strong> "Knowledge is power," but only as long as action is taken. Check out Statly's full Artificial Intelligence engine for live updates on actionable data... Or in other words, "Power."
            </p>
            

            
        </div>
    </div>
</div>
    <div class="form-group">
        <a href="?page=statly-setting-admin&step=1" class="pull-right integrationclass" >Remove Integration</a>
    </div>