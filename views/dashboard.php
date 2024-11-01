<?php
include 'wizard/header.php';
?>

<div class="col-sm-3 text-center">
    <div class="panel">
        <div class="panel-header">
            <p class="glyphicon glyphicon-eye-open dash-icon" style="padding-top: 15px;"></p>  
            <p><span class="ribbon-views-today">0</span> Views today</p>
        </div>
    </div>
</div>
<div class="col-sm-3 text-center">
    <div class="panel">
        <div class="panel-header">
            <p class="glyphicon glyphicon-user dash-icon" style="padding-top: 15px;"></p> 
            <p><span class="ribbon-visitors-today">0</span> Visitors today</p>
        </div>
    </div>
</div>
<div class="col-sm-3 text-center">
    <div class="panel">
        <div class="panel-header">
            <div style="padding-top: 15px;">
                <p class="glyphicon glyphicon-refresh glyphicon-refresh-animate spin"></p>  
                <p><span class="ribbon-live">0</span> Live visitors</p>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-3 text-center ">
    <div class="panel">
        <div class="panel-header"  style="padding-top: 15px;">
            <a target="_blank" href="https://app.statly.org" class="btn btn-block btn-full-dahsboard">Go to full dashboard</a>
        </div>
    </div>
</div>
<div class="col-sm-12">
    <div class="panel">
        <div class="panel-header">
            <div class="row">
                <div class="col-sm-6">
                    <select class="form-control d-inline" id="dashboard-stats-dd">
                        <option value="Views" selected="selected">Views</option>
                        <option value="Sessions">Sessions</option>
                        <option value="Visitors">Visitors</option>
                        <option value="Bounce Rate">Bounce Rate</option>
                    </select>
                    <div class="d-inline">
                        vs
                    </div>
                    <select class="form-control d-inline" id="dashboard-stats-dd2">
                        <option value="" selected="selected">Select a matric</option>
                        <option value="Views">Views</option>
                        <option value="Sessions">Sessions</option>
                        <option value="Visitors">Visitors</option>
                        <option value="Bounce Rate">Bounce Rate</option>
                    </select>
                    <div class="d-inline">
                        <p id="dashboard-stats-close" class="glyphicon glyphicon-remove-sign"></p>
                    </div>
                    <div>
                        <strong id="dashboard-stats-label" class="d-inline">Views</strong>
                        <span id="dashboard-stats-label-vs" class="d-inline"></span>
                        <strong id="dashboard-stats-label2" class="d-inline"></strong>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="daterange-wrapper">
                                <div class="input-group input-daterange">
                                    <input id="reportrange_start" type="text" name="from_date" value="<?= $date_start ?>" required="" class="form-control">
                                    <span class="input-group-addon">to</span>
                                    <input id="reportrange_end" type="text" name="to_date" value="<?= $date_end ?>" required="" class="form-control">
                                </div>									
                                <button class="btn btn-primary input-daterange-btn">Apply</button>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-center">
                            <div class="btn-group btn-group-sm dashboard-btn-group" role="group" aria-label="Default button group">
                                <button type="button" class="btn btn-default active daily_page_views">Daily</button>
                                <button type="button" class="btn btn-default weekly_page_views">Weekly</button>
                                <button type="button" class="btn btn-default monthly_page_views">Monthly</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div id="daily_views_chart_wrapper" style="height: 200px;">
                <div id="daily_views_chart" style="height: 200px;"></div>
                <div class='loader'><p class="glyphicon glyphicon-refresh glyphicon-refresh-animate spin"></p></div>
            </div>

        </div>
    </div>
</div>
<div id="other-wigets">
    <div class="col-sm-4 text-center">
        <div class="panel">
            <div class="panel-header">
                <strong>New and Returning Visitors</strong>
            </div>
            <div class="panel-body">
                <div id="visitors_chart" style="height: 230px;"></div>
            </div>
        </div>
    </div>
    <div class="col-sm-4 text-center">
        <div class="panel">
            <div class="panel-header">
                <strong>Website Ranking</strong>
            </div>
            <div class="panel-body">
                <div style="height: 230px;">
                    <h3 class="ranking"><?= $site_ranking ?></h3>
                    <div>
                        <a target="_blank" href="https://statly.org/upgrade">
                            <strong>Upgrade</strong>
                        </a> to see how to fix it
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4 text-center">
        <div class="panel">
            <div class="panel-header">
                <strong>Bottlenecks</strong>
            </div>
            <div class="panel-body">
                <div style="height: 220px;">
                    <h3 class="bottlenecks"><?= $bottlenecks ?></h3>
                    <strong>Opportunities</strong>
                    <h3 class="opportunities"><?= $opportunities ?></h3>
                    <div>
                        <a target="_blank" href="https://statly.org/upgrade">
                            <strong>Upgrade</strong>
                        </a> to see where your customers are falling off your funnel
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <script src="<?= plugin_dir_url(__FILE__) . '../js/highcharts.js' ?>"></script>
    <script type="text/javascript" src="<?= plugin_dir_url(__FILE__) . '../js/moment.js' ?>"></script>
    <script src="<?= plugin_dir_url(__FILE__) . '../js/pikaday.min.js' ?>"></script>
    <script src="<?= plugin_dir_url(__FILE__) . '../js/pikaday-responsive-modernizr.js' ?>"></script>
    <script src="<?= plugin_dir_url(__FILE__) . '../js/pikaday-responsive.min.js' ?>"></script>
    <script src="<?= plugin_dir_url(__FILE__) . '../js/raphael-min.js' ?>"></script>
    <script src="<?= plugin_dir_url(__FILE__) . '../js/morris.min.js' ?>"></script>
    <script type="text/javascript" >
    jQuery(document).ready(function ($) {
        pikadayResponsive('#reportrange_start');
        pikadayResponsive('#reportrange_end');
    
        fetchLiveData();
        setInterval(function () {
        fetchLiveData();
        }, 5000);
        $(".input-daterange-btn").click(function(){
            window.location = "admin.php?page=statly-setting-admin&date_start="+$("#reportrange_start").val()+"&date_end="+$("#reportrange_end").val();
        });
    });
    function fetchLiveData() {
    jQuery.get("admin-ajax.php?action=saasft_statly_live_stats", function (response) {
    var jsonresponse = JSON.parse(response);
    if (jsonresponse.error) {
        window.location = "admin.php?page=statly-setting-admin&tab=login";
    } else {
        $(".ribbon-views-today").text(jsonresponse.views);
        $(".ribbon-visitors-today").text(jsonresponse.visitors);
        $(".ribbon-live").text(jsonresponse.live);
    }

    });
    }
    function get_cookie(cookie_name)
    {
    var results = document.cookie.match('(^|;) ?' + cookie_name + '=([^;]*)(;|$)');

    if (results)
    return (unescape(results[2]));
    else
    return null;
    }
    //var cur_data = JSON.parse(get_cookie( 'analytics_dashboard_cur_data' ));
    var cur_ykeys = get_cookie('analytics_dashboard_cur_ykeys');
    var cur_labels = get_cookie('analytics_dashboard_cur_labels');
    var cur_ykeys2 = get_cookie('analytics_dashboard_cur_ykeys2');
    var cur_labels2 = get_cookie('analytics_dashboard_cur_labels2');
    var cur_type = get_cookie('analytics_dashboard_cur_type');
    var dd_type = get_cookie('analytics_dashboard_dd_type');

    if (!cur_ykeys) {
    cur_ykeys = 'views_count';
    }
    if (!cur_labels) {
    cur_labels = 'Views';
    }
    if (!cur_ykeys2) {
    cur_ykeys2 = 'views_count';
    }
    if (!cur_labels2) {
    cur_labels2 = 'Views';
    }
    var daily_views = <?= json_encode($daily) ?>;
    var weekly_views = <?= json_encode($weekly) ?>;
    var monthly_views = <?= json_encode($monthly) ?>;
    var cur_data = daily_views;

    if (cur_type == 'week')
    cur_data = weekly_views;
    else if (cur_type == 'month')
    cur_data = monthly_views;

    if (!cur_type) {
    cur_type = 'day';
    }
    if (!dd_type) {
    dd_type = 1;
    }
    var chart;
    createViewsChart(cur_data, cur_ykeys, cur_labels, cur_ykeys2, cur_labels2, cur_type, dd_type);
    function createViewsChart(cur_data, cur_ykeys, cur_labels, cur_ykeys2, cur_labels2, cur_type, dd_type) {
    $("#daily_views_chart").empty();
    $("#dashboard-stats-label").html(cur_labels);
    $("#dashboard-stats-label2").html(cur_labels2);
    $("#dashboard-stats-label-vs").html("vs");
    //document.cookie = "analytics_dashboard_cur_data="+JSON.stringify(cur_data);
    document.cookie = "analytics_dashboard_cur_ykeys=" + cur_ykeys;
    document.cookie = "analytics_dashboard_cur_labels=" + cur_labels;
    document.cookie = "analytics_dashboard_cur_ykeys2=" + cur_ykeys2;
    document.cookie = "analytics_dashboard_cur_labels2=" + cur_labels2;
    document.cookie = "analytics_dashboard_cur_type=" + cur_type;
    document.cookie = "analytics_dashboard_dd_type=" + dd_type;
    var ykeysData = [cur_ykeys];
    var labelData = [cur_labels];
    if (dd_type == 2) {
    ykeysData = [cur_ykeys, cur_ykeys2];
    labelData = [cur_labels, cur_labels2];
    $("#dashboard-stats-dd2").val(cur_labels2);
    $("#dashboard-stats-close").css('display', 'block');
    } else {
    $("#dashboard-stats-close").css('display', 'none');
    $("#dashboard-stats-label2").html("");
    $("#dashboard-stats-label-vs").html("");
    }
    var chart_data = {
    element: 'daily_views_chart',
    data: cur_data,
    xkey: ['date'],
    ykeys: ykeysData,
    labels: labelData,
    xLabels: cur_type,
    hoverCallback: function (index, options, content, row) {
        if (cur_type != "day") {
            var date = row.date;
            content = content.replace(date, row.dt_start + " - " + row.dt_end);
        }
        if (cur_ykeys == "bounces_count" || cur_ykeys2 == "bounces_count") {
            content = content.replace(/\s*\n\s*/g, "");
            var divisor = row.sessions_count;
            if (divisor == 0)
                divisor = 1;
            content = content.replace(/Bounce Rate:[0-9]+/g, "Bounce Rate:" + Math.round(row.bounces_count / divisor * 100) + "%");
        }
        return content;
    },
    resize: true,
    redraw: true,

    };

    chart = new Morris.Line(chart_data);
    $(".dashboard-btn-group button").removeClass("active");
    if (cur_type == 'day')
    $('.daily_page_views').addClass("active");
    else if (cur_type == 'week')
    $('.weekly_page_views').addClass("active");
    else if (cur_type == 'month')
    $('.monthly_page_views').addClass("active");
    $(".loader").css('display', 'none');
    $("#dashboard-stats-dd").val(cur_labels);
    }
    $('.daily_page_views').click(function () {
        cur_data = daily_views;
        cur_type = 'day';
        createViewsChart(daily_views, cur_ykeys, cur_labels, cur_ykeys2, cur_labels2, cur_type, dd_type);
    });
    

    $('.weekly_page_views').click(function () {
        cur_data = weekly_views;
        cur_type = 'week';
        createViewsChart(weekly_views, cur_ykeys, cur_labels, cur_ykeys2, cur_labels2, cur_type, dd_type);
    });
    $('.monthly_page_views').click(function () {
        cur_data = monthly_views;
        cur_type = 'month';
        createViewsChart(monthly_views, cur_ykeys, cur_labels, cur_ykeys2, cur_labels2, cur_type, dd_type);
    });
    $("#dashboard-stats-close").click(function () {
    $("#dashboard-stats-dd2").val("");
    $("#dashboard-stats-dd2").change();
    });
    $("#dashboard-stats-dd").change(function () {
    dd_type = 2;
    if ($("#dashboard-stats-dd2").val() == "")
    dd_type = 1;
    var curr_val = $(this).val();
    if (curr_val == "Views") {
    cur_labels = 'Views';
    cur_ykeys = 'views_count';
    } else if (curr_val == "Sessions") {
    cur_labels = 'Sessions';
    cur_ykeys = 'sessions_count';
    } else if (curr_val == "Visitors") {
    cur_labels = 'Visitors';
    cur_ykeys = 'visitors_count';
    } else if (curr_val == "Bounce Rate") {
    cur_labels = 'Bounce Rate';
    cur_ykeys = 'bounces_count';
    }

    createViewsChart(cur_data, cur_ykeys, cur_labels, cur_ykeys2, cur_labels2, cur_type, dd_type);
    });
    $("#dashboard-stats-dd2").change(function () {
    var curr_val = $(this).val();
    dd_type = 2;
    if (curr_val == "")
    dd_type = 1;

    if (curr_val == "Views") {
    cur_labels2 = 'Views';
    cur_ykeys2 = 'views_count';
    } else if (curr_val == "Sessions") {
    cur_labels2 = 'Sessions';
    cur_ykeys2 = 'sessions_count';
    } else if (curr_val == "Visitors") {
    cur_labels2 = 'Visitors';
    cur_ykeys2 = 'visitors_count';
    } else if (curr_val == "Bounce Rate") {
    cur_labels2 = 'Bounce Rate';
    cur_ykeys2 = 'bounces_count';
    }
    createViewsChart(cur_data, cur_ykeys, cur_labels, cur_ykeys2, cur_labels2, cur_type, dd_type);
    });

    Highcharts.setOptions({
        colors: ['#1D3388','#D0D0D0', '#0665A9', '#4E5880', 'lightblue', 'grey']
    });

    Highcharts.chart('visitors_chart', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie',
            options3d: {
                enabled: false,
                alpha: 45
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>'+this.point.name+'</b><br>Visitors ('+this.y+'): '+Math.round(this.point.percentage*10)/10+'%';
            }
        },
        title:{
            text: null
        },
        plotOptions: {
            pie: {
                cursor: 'pointer',
                dataLabels: {
                    format: '<b>{point.name}</b> ({point.y}): {point.percentage:.1f} %',

                },
                innerSize: 0,
                depth: 45
            }
        },
        series: [{
            colorByPoint: true,
            data: [{
                name: 'New',
                y: <?= $new_visitors ?>
                }, {
                name: 'Returning',
                y: <?= $existing_visitors ?>
            }]
        }]
    });
    </script>