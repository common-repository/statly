<?php
include 'wizard/header.php';
$selected = "";
if(get_option( 'saasft_enable_utm' )){
    $selected = "checked";
}
?>
<div class="col-sm-8">
    <form method="post" action="admin.php">
        <?php
        settings_fields('statly_links');
        ?>
        <div class="form-section-heading">
        </div>
        <div class="form-section-content">
            <div class="form-group">
                <div class="checkbox">
                    <label style="margin: 10px;margin-left: 0px;padding-left: 0px;"><strong>UTM Tracking<strong> <span class="recommended">(recommended)</span></strong></label>
                    <br>
                    <label>
                        <input type="hidden" name="saasft_enable_utm" value="0">
                        <input type="checkbox" id="enable_utm" name="saasft_enable_utm" <?= $selected ?>>
                        Enable UTM variables on all outgoing links? <span class="recommended">(recommended)</span>
                    </label>
                    <p style="margin: 10px;">UTM stands for Urchin Tracking Module; the format used by Google to track your unique URLs. By allowing us to add tracking codes to your posts, pages, and content we can give you actionable data on how to convert more in the future</p>
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
            <div class="form-section-heading">Knowledge Card</div> 
                <p class="form-section-subheading">
                    With Statly installed and set up, you can now be sure the every page, post, and link is bring tracked. With that data we create:
                <h4 style="text-align: center;">AI Auto funnel</h4> 
                <p>Mathematical method for optimizing your conversions and increase revenue</p>
                <img src="https://blogs.sas.com/content/graphicallyspeaking/files/2017/03/Funnel_Example.png" alt="conversions" class="mapevents">
                <h4 style="text-align: center;">Reverse Conversion</h4> 
                <p>Machine learning approach to better understanding of how your customers move through your website </p>
                <img src="http://res.cloudinary.com/heliumup/image/upload/v1533862121/2018-08-09_18-48-27.png" alt="conversions" class="mapevents">
            </p> 
        </div>
    </div>
</div>