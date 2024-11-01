<?php
include 'header.php';
$site_url = get_site_url();
$site_url_without_scheme = preg_replace("/^http(s)?:\/\//", "", $site_url);

$total_pages = 0;
$total_events = 0;
$categories_dd = [];
?>
<div class="content-section">
    <div class="margin-top-20">
        <div class="col-sm-12">
                <h4 style="text-align: center;">Map Pages to Events </h4> 
                <img src="http://3.bp.blogspot.com/-Ur2LPVQB_jM/VGfsCE1GWPI/AAAAAAAABxU/BIhtRQ55pHs/s1600/DragDropInteractions.gif" alt="conversions" class="mapevents">
        </div>
    </div>
    <div class="margin-bottom-30">
        <div class="col-sm-4">
            <b>Your Webistes Pages</b>
            <div class="well center-block" id="wp-pages">
                <?php
                $pages = get_pages();
                $total_pages = count($pages);
                foreach ($pages as $page) {
                    $post_name = $page->post_name;
                    $post_title = $page->post_title;
                    $page_link = preg_replace("/^http(s)?:\/\//", "", get_page_link($page->ID));
                    echo '<div class="btn btn-default btn-lg btn-block" page_link="' . str_replace($site_url_without_scheme, "", $page_link) . '">' . $post_title . '</div>';
                }
                ?>
            </div>
            <p>Total Pages (<?= $total_pages ?>)</p>
        </div>
        <div class="col-sm-8">
            <b>Funnel Events</b>
            <div id="events-list" class="row">
                <?php
                if (isset($categories[0])) {
                    foreach ($categories as $category) {
                        $total_events += count($category->events);
                        $categories_dd[$category->id] = $category->name;
                        ?>
                        <div class="col-sm-6 dragNdrop">
                            <div class="event-cat">
                                <div class="pages-count">
                                    (<span class="count"><?= count($category->events) ?></span>)
                                </div>
                                <div class="cat-name" val="<?= $category->id ?>"><?= $category->name ?></div>

                                <div class="dropdown">
                                    <div class="event-arrow dropdown-toggle" data-toggle="dropdown" >

                                    </div>
                                    <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">
                                        <?php
                                        if (isset($category->events) && count($category->events) > 0) {
                                            foreach ($category->events as $event) {
                                                ?>
                                                <li><span><?= $event->name ?><a href="?page=statly-setting-admin&tab=events&event_id=<?= $event->id ?>" class="close">&times;</a></span></li>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <li><span>No event found</span></li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo '<div class="col-sm-12">No event category found, please reload page again</div>';
                }
                ?>
            </div>
            <p>Total Events (<?= $total_events ?>)</p>
        </div>
    </div>
    <?php if ($saasft_curr_step == 3) { ?>
        <div class="action-btns content-row">
            <div class="col-xs-6">
                <a href="?page=statly-setting-admin&step=2">
                    <button type="button" class="btn btn-primary btn-circle btn-lg"><i class="glyphicon glyphicon-chevron-left"></i></button>
                </a>
            </div>
            <div class="col-xs-6">
                <a href="?page=statly-setting-admin&step=4">
                    <button class="btn btn-primary btn-circle btn-lg"  onclick="ShowLoading()"><i class="glyphicon glyphicon-chevron-right"></i></button>
                </a>
            </div>
        </div>
    <?php } ?>
</div>
<div class="text-right" style="margin: 20px;">
            <a id="addEvent" class="btn btn-primary">Create Custom Event</a>
        </div>
<div class="loading-section">
    <ul class="loading-points" style="padding-top: 120px;">
        <li><img src="<?= plugin_dir_url(__FILE__) . '../../img/loading.gif' ?>"/></li>
        <li>Mapping Funnels</li>
        <li>Indexing Pages</li>
        <li>Creating Site Map</li>
    </ul>
</div>
<div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="addEventLabel"><span>Create</span> Event</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="admin.php">
                    <?php
                    settings_fields('statly_events_settings');
                    ?>
                    <div class="form-group">
                        <label>Category</label>
                        <select required="required" id="category" name="saasft_statly_event[category_id]" class="form-control select2 select2-hidden-accessible" placeholder="Select a category..." tabindex="-1" aria-hidden="true">
                            <?php
                            foreach($categories_dd as $category_id => $category_name){
                                echo '<option value="'.$category_id.'">'.$category_name.'</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <input required="required" type="text" name="saasft_statly_event[name]" class="form-control" id="inputName" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label for="inputValue">Value ($)</label>
                        <input required="required" type="text" name="saasft_statly_event[value]" class="form-control" id="inputValue" placeholder="" value="">
                    </div>
                    <div class="form-group">
                        <label>Match Type</label>
                        <select name="saasft_statly_event[match_type]" class="form-control select2 select2-hidden-accessible" tabindex="-1" aria-hidden="true">
                            <option value="Exact match">Exact match</option>
                            <option value="Begins with">Begins with</option>
                            <option value="URL Path">URL Path</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label id="input-url-uri" for="inputUrl">URL</label>
                        <div class="input-group readonly_urlfield">
                            <span class="input-group-addon"><?= $site_url ?></span>
                            <input placeholder="Enter URL path, query string etc" type="text" name="saasft_statly_event[url]" class="form-control" id="inputUrl" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDescription">Description</label>
                        <textarea name="saasft_statly_event[description]" class="form-control" id="inputDescription" placeholder=""></textarea>
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="saasft_statly_event[is_goal]" id="inputIsGoal"> This is a goal
                        </label>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-primary">Create</button>
                            <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>