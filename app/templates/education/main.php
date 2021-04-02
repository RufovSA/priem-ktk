<?php

use Reagordi\Framework\Web\Asset;

if ( !Reagordi::$app->context->request->isAjaxRequest() ):
?>
<!DOCTYPE html>
<html lang="<?= LANGUAGE_ID ?>">
<head>
    <?= Reagordi::getInstance()->getContext()->getHead() ?>
    <!--Morris Chart CSS -->
<?= Asset::getInstance()->addCss(TEMPLATE_URL . '/plugins/morris/morris.css') ?>
<?= Asset::getInstance()->addCss(TEMPLATE_URL . '/css/bootstrap.min.css') ?>
<?= Asset::getInstance()->addCss(TEMPLATE_URL . '/css/core.css') ?>
<?= Asset::getInstance()->addCss(TEMPLATE_URL . '/css/components.css') ?>
<?= Asset::getInstance()->addCss(TEMPLATE_URL . '/css/icons.css') ?>
<?= Asset::getInstance()->addCss(TEMPLATE_URL . '/css/pages.css') ?>
<?= Asset::getInstance()->addCss(TEMPLATE_URL . '/css/responsive.css') ?>
<?= Asset::getInstance()->addCss(TEMPLATE_URL . '/plugins/fileinput/css/fileinput.css') ?>
<?= Asset::getInstance()->addCss(TEMPLATE_URL . '/plugins/stfileicons/css/stfileicons.css') ?>

    <link rel="shortcut icon" href="<?= Asset::getInstance()->addFileUrl( TEMPLATE_URL . '/favicon.ico' ) ?>" />
    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
<style>
body {
    overflow-x: hidden;
}

.topbar {
    position: relative;
}

.content-page > .content {
    margin-top: 0;
}

.color-red{
    color: #ff0000;
}

#rde_load, #ep_block_addres_fact {
    display: none;
}

#rde_load .box_layer_bg {
    position: fixed;
    background-color: #000;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: 9000;
    overflow: hidden;
    opacity: .7;
    left: 0;
}

#rde_load .box_layer_wrap {
    position: fixed;
    z-index: 10000;
    width: 100px;
    top: 50%;
    left: 50%;
    margin: -50px auto 0 -50px;
}

    .lds-roller {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
    }
    .lds-roller div {
        animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
        transform-origin: 40px 40px;
    }
    .lds-roller div:after {
        content: " ";
        display: block;
        position: absolute;
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #fff;
        margin: -4px 0 0 -4px;
    }
    .lds-roller div:nth-child(1) {
        animation-delay: -0.036s;
    }
    .lds-roller div:nth-child(1):after {
        top: 63px;
        left: 63px;
    }
    .lds-roller div:nth-child(2) {
        animation-delay: -0.072s;
    }
    .lds-roller div:nth-child(2):after {
        top: 68px;
        left: 56px;
    }
    .lds-roller div:nth-child(3) {
        animation-delay: -0.108s;
    }
    .lds-roller div:nth-child(3):after {
        top: 71px;
        left: 48px;
    }
    .lds-roller div:nth-child(4) {
        animation-delay: -0.144s;
    }
    .lds-roller div:nth-child(4):after {
        top: 72px;
        left: 40px;
    }
    .lds-roller div:nth-child(5) {
        animation-delay: -0.18s;
    }
    .lds-roller div:nth-child(5):after {
        top: 71px;
        left: 32px;
    }
    .lds-roller div:nth-child(6) {
        animation-delay: -0.216s;
    }
    .lds-roller div:nth-child(6):after {
        top: 68px;
        left: 24px;
    }
    .lds-roller div:nth-child(7) {
        animation-delay: -0.252s;
    }
    .lds-roller div:nth-child(7):after {
        top: 63px;
        left: 17px;
    }
    .lds-roller div:nth-child(8) {
        animation-delay: -0.288s;
    }
    .lds-roller div:nth-child(8):after {
        top: 56px;
        left: 12px;
    }
    @keyframes lds-roller {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

</style>
</head>
<body class="fixed-left">
    <div id="rde_load">
        <div class="box_layer_bg"></div>
        <div class="box_layer_wrap">
            <div class="lds-roller">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->
    <div class="topbar">

        <!-- LOGO -->
        <div class="topbar-left">
            <div class="text-center">
                <a href="<?= HOME_URL ?>" class="logo">
                    <span><?= Reagordi::getInstance()->getConfig()->get('site_name') ?></span>
                </a>
                <!-- Image Logo here -->
                <!--<a href="index.html" class="logo">-->
                <!--<i class="icon-c-logo"> <img src="assets/images/logo_sm.png" height="42"/> </i>-->
                <!--<span><img src="assets/images/logo_light.png" height="20"/></span>-->
                <!--</a>-->
            </div>
        </div>

        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="">
                    <!--<div class="pull-left">
                        <button class="button-menu-mobile open-left waves-effect waves-light">
                            <i class="md md-menu"></i>
                        </button>
                        <span class="clearfix"></span>
                    </div>-->

                    <!--
                    <ul class="nav navbar-nav navbar-right pull-right">
                        <li class="dropdown top-menu-item-xs">
                            <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><img src="{TEMPLATE_URL}/images/users/avatar-1.jpg" alt="user-img" class="img-circle"> </a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)"><i class="ti-user m-r-10 text-custom"></i> Profile</a></li>
                                <li><a href="javascript:void(0)"><i class="ti-settings m-r-10 text-custom"></i> Settings</a></li>
                                <li><a href="javascript:void(0)"><i class="ti-lock m-r-10 text-custom"></i> Lock screen</a></li>
                                <li class="divider"></li>
                                <li><a href="javascript:void(0)"><i class="ti-power-off m-r-10 text-danger"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>-->
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>
    </div>
    <!-- Top Bar End -->


    <!-- ========== Left Sidebar Start ========== -->

    <!--<div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">
            <div id="sidebar-menu">
                <ul>

                    <li class="text-muted menu-title">Navigation</li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-home"></i> <span> Dashboard </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="index.html">Dashboard 1</a></li>
                            <li><a href="dashboard_2.html">Dashboard 2</a></li>
                            <li><a href="dashboard_3.html">Dashboard 3</a></li>
                            <li><a href="dashboard_4.html">Dashboard 4</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-paint-bucket"></i> <span> UI Kit </span> <span class="menu-arrow"></span> </a>
                        <ul class="list-unstyled">
                            <li><a href="ui-buttons.html">Buttons</a></li>
                            <li><a href="ui-loading-buttons.html">Loading Buttons</a></li>
                            <li><a href="ui-panels.html">Panels</a></li>
                            <li><a href="ui-portlets.html">Portlets</a></li>
                            <li><a href="ui-checkbox-radio.html">Checkboxs-Radios</a></li>
                            <li><a href="ui-tabs.html">Tabs</a></li>
                            <li><a href="ui-modals.html">Modals</a></li>
                            <li><a href="ui-progressbars.html">Progress Bars</a></li>
                            <li><a href="ui-notification.html">Notification</a></li>
                            <li><a href="ui-images.html">Images</a></li>
                            <li><a href="ui-carousel.html">Carousel</a>
                            <li><a href="ui-video.html">Video</a>
                            <li><a href="ui-bootstrap.html">Bootstrap UI</a></li>
                            <li><a href="ui-typography.html">Typography</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-light-bulb"></i><span class="label label-primary pull-right">9</span><span> Components </span> </a>
                        <ul class="list-unstyled">
                            <li><a href="components-grid.html">Grid</a></li>
                            <li><a href="components-widgets.html">Widgets</a></li>
                            <li><a href="components-nestable-list.html">Nesteble</a></li>
                            <li><a href="components-range-sliders.html">Range sliders</a></li>
                            <li><a href="components-masonry.html">Masonry</a></li>
                            <li><a href="components-animation.html">Animation</a></li>
                            <li><a href="components-sweet-alert.html">Sweet Alerts</a></li>
                            <li><a href="components-treeview.html">Treeview</a></li>
                            <li><a href="components-tour.html">Tour</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-spray"></i> <span> Icons </span> <span class="menu-arrow"></span> </a>
                        <ul class="list-unstyled">
                            <li><a href="icons-glyphicons.html">Glyphicons</a></li>
                            <li><a href="icons-materialdesign.html">Material Design</a></li>
                            <li><a href="icons-ionicons.html">Ion Icons</a></li>
                            <li><a href="icons-fontawesome.html">Font awesome</a></li>
                            <li><a href="icons-themifyicon.html">Themify Icons</a></li>
                            <li><a href="icons-simple-line.html">Simple line Icons</a></li>
                            <li><a href="icons-weather.html">Weather Icons</a></li>
                            <li><a href="icons-typicons.html">Typicons</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-pencil-alt"></i><span> Forms </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="form-elements.html">General Elements</a></li>
                            <li><a href="form-advanced.html">Advanced Form</a></li>
                            <li><a href="form-validation.html">Form Validation</a></li>
                            <li><a href="form-pickers.html">Form Pickers</a></li>
                            <li><a href="form-wizard.html">Form Wizard</a></li>
                            <li><a href="form-mask.html">Form Masks</a></li>
                            <li><a href="form-summernote.html">Summernote</a></li>
                            <li><a href="form-wysiwig.html">Wysiwig Editors</a></li>
                            <li><a href="form-code-editor.html">Code Editor</a></li>
                            <li><a href="form-uploads.html">Multiple File Upload</a></li>
                            <li><a href="form-xeditable.html">X-editable</a></li>
                            <li><a href="form-image-crop.html">Image Crop</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-menu-alt"></i><span>Tables </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="tables-basic.html">Basic Tables</a></li>
                            <li><a href="tables-datatable.html">Data Table</a></li>
                            <li><a href="tables-editable.html">Editable Table</a></li>
                            <li><a href="tables-responsive.html">Responsive Table</a></li>
                            <li><a href="tables-foo-tables.html">FooTable</a></li>
                            <li><a href="tables-bootstrap.html">Bootstrap Tables</a></li>
                            <li><a href="tables-tablesaw.html">Tablesaw Tables</a></li>
                            <li><a href="tables-jsgrid.html">JsGrid Tables</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-bar-chart"></i><span class="label label-pink pull-right">11</span><span> Charts </span></a>
                        <ul class="list-unstyled">
                            <li><a href="chart-flot.html">Flot Chart</a></li>
                            <li><a href="chart-morris.html">Morris Chart</a></li>
                            <li><a href="chart-chartjs.html">Chartjs</a></li>
                            <li><a href="chart-peity.html">Peity Charts</a></li>
                            <li><a href="chart-chartist.html">Chartist Charts</a></li>
                            <li><a href="chart-c3.html">C3 Charts</a></li>
                            <li><a href="chart-nvd3.html"> Nvd3 Charts</a></li>
                            <li><a href="chart-sparkline.html">Sparkline charts</a></li>
                            <li><a href="chart-radial.html">Radial charts</a></li>
                            <li><a href="chart-other.html">Other Chart</a></li>
                            <li><a href="chart-ricksaw.html">Ricksaw Chart</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-location-pin"></i><span> Maps </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="map-google.html"> Google Map</a></li>
                            <li><a href="map-vector.html"> Vector Map</a></li>
                        </ul>
                    </li>

                    <li class="text-muted menu-title">More</li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-files"></i><span> Pages </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="page-starter.html">Starter Page</a></li>
                            <li><a href="page-login.html">Login</a></li>
                            <li><a href="page-login-v2.html">Login v2</a></li>
                            <li><a href="page-register.html">Register</a></li>
                            <li><a href="page-register-v2.html">Register v2</a></li>
                            <li><a href="page-signup-signin.html">Signin - Signup</a></li>
                            <li><a href="page-recoverpw.html">Recover Password</a></li>
                            <li><a href="page-lock-screen.html">Lock Screen</a></li>
                            <li><a href="page-400.html">Error 400</a></li>
                            <li><a href="page-403.html">Error 403</a></li>
                            <li><a href="page-404.html">Error 404</a></li>
                            <li><a href="page-404_alt.html">Error 404-alt</a></li>
                            <li><a href="page-500.html">Error 500</a></li>
                            <li><a href="page-503.html">Error 503</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-gift"></i><span> Extras </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="extra-profile.html">Profile</a></li>
                            <li><a href="extra-timeline.html">Timeline</a></li>
                            <li><a href="extra-sitemap.html">Site map</a></li>
                            <li><a href="extra-invoice.html">Invoice</a></li>
                            <li><a href="extra-email-template.html">Email template</a></li>
                            <li><a href="extra-maintenance.html">Maintenance</a></li>
                            <li><a href="extra-coming-soon.html">Coming-soon</a></li>
                            <li><a href="extra-faq.html">FAQ</a></li>
                            <li><a href="extra-search-result.html">Search result</a></li>
                            <li><a href="extra-gallery.html">Gallery</a></li>
                            <li><a href="extra-pricing.html">Pricing</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-crown"></i><span class="label label-success pull-right">3</span><span> Apps </span></a>
                        <ul class="list-unstyled">
                            <li><a href="apps-calendar.html"> Calendar</a></li>
                            <li><a href="apps-contact.html"> Contact</a></li>
                            <li><a href="apps-taskboard.html"> Taskboard</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-email"></i><span> Email </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="email-inbox.html"> Inbox</a></li>
                            <li><a href="email-read.html"> Read Mail</a></li>
                            <li><a href="email-compose.html"> Compose Mail</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-widget"></i><span> Layouts </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="layout-leftbar_2.html"> Leftbar with User</a></li>
                            <li><a href="layout-menu-collapsed.html"> Menu Collapsed</a></li>
                            <li><a href="layout-menu-small.html"> Small Menu</a></li>
                            <li><a href="layout-header_2.html"> Header style</a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-share"></i><span>Multi Level </span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><span>Menu Level 1.1</span>  <span class="menu-arrow"></span></a>
                                <ul style="">
                                    <li><a href="javascript:void(0);"><span>Menu Level 2.1</span></a></li>
                                    <li><a href="javascript:void(0);"><span>Menu Level 2.2</span></a></li>
                                    <li><a href="javascript:void(0);"><span>Menu Level 2.3</span></a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);"><span>Menu Level 1.2</span></a>
                            </li>
                        </ul>
                    </li>

                    <li class="text-muted menu-title">Extra</li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-user"></i><span> Crm </span> <span class="menu-arrow"></span></a>
                        <ul class="list-unstyled">
                            <li><a href="crm-dashboard.html"> Dashboard </a></li>
                            <li><a href="crm-contact.html"> Contacts </a></li>
                            <li><a href="crm-opportunities.html"> Opportunities </a></li>
                            <li><a href="crm-leads.html"> Leads </a></li>
                            <li><a href="crm-customers.html"> Customers </a></li>
                        </ul>
                    </li>

                    <li class="has_sub">
                        <a href="javascript:void(0);" class="waves-effect"><i class="ti-shopping-cart"></i><span class="label label-warning pull-right">6</span><span> eCommerce </span></a>
                        <ul class="list-unstyled">
                            <li><a href="ecommerce-dashboard.html"> Dashboard</a></li>
                            <li><a href="ecommerce-products.html"> Products</a></li>
                            <li><a href="ecommerce-product-detail.html"> Product Detail</a></li>
                            <li><a href="ecommerce-product-edit.html"> Product Edit</a></li>
                            <li><a href="ecommerce-orders.html"> Orders</a></li>
                            <li><a href="ecommerce-sellers.html"> Sellers</a></li>
                        </ul>
                    </li>

                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>-->
    <!-- Left Sidebar End -->



    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="content-page" style="margin-left:0">
        <!-- Start content -->
        <div class="content">
            <div id="page_context" class="container">
<?php endif ?>
                <!--------------------------------------------------------------------------------------------------------->
                <?php if ( isset($conteiner) ): ?>
                    <?= $conteiner ?>
                <?php else: ?>
                    <br />
                    <div class="alert alert-danger">Данная страница удаленна или ещё не созданна</div>
                <?php endif ?>
                <!---------------------------------------------------------------------->
<?php if ( !Reagordi::$app->context->request->isAjaxRequest() ): ?>
            </div> <!-- container -->

        </div> <!-- content -->

        <footer class="footer text-right" style="left:0">
            <a href="/"><?= Reagordi::getInstance()->getConfig()->get('site_name') ?></a> &copy; <?= date('Y') ?>. Все права защищены
        </footer>

    </div>
</div>
<!-- END wrapper -->
<script>var resizefunc=[]</script>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/modernizr.min.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/jquery.min.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/bootstrap.min.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/detect.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/fastclick.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/jquery.slimscroll.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/jquery.blockUI.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/waves.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/wow.min.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/jquery.nicescroll.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/jquery.scrollTo.min.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/plugins/peity/jquery.peity.min.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/plugins/waypoints/lib/jquery.waypoints.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/plugins/counterup/jquery.counterup.min.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/plugins/raphael/raphael-min.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/plugins/jquery-knob/jquery.knob.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/jquery.core.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/jquery.app.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/bootstrap-formhelpers-phone.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/plugins/ladda-buttons/js/spin.min.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/plugins/ladda-buttons/js/ladda.min.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/plugins/ladda-buttons/js/ladda.jquery.min.js') ?>

<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/plugins/fileinput/js/fileinput.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/plugins/fileinput/js/locales/ru.js') ?>

<?= Reagordi::getInstance()->getContext()->getFooter() ?>
<script>
    $(document).ready(function($) {
        $('.counter').counterUp({
            delay: 100,
            time: 1200
        });

        $('.ladda-button').ladda();
        try{
            $('.ep_addres').select2({
                maximumSelectionLength: 2,
                language: "<?= LANGUAGE_ID ?>"
            });
        } catch (e){}

        /*$(".knob").knob();

        // Bind normal buttons
        $('.ladda-button').ladda('bind', {timeout: 2000});

        // Bind progress buttons and simulate loading progress
        Ladda.bind('.progress-demo .ladda-button', {
            callback: function (instance) {
                var progress = 0;
                var interval = setInterval(function () {
                    progress = Math.min(progress + Math.random() * 0.1, 1);
                    instance.setProgress(progress);

                    if (progress === 1) {
                        instance.stop();
                        clearInterval(interval);
                    }
                }, 200);
            }
        });*/


        /*var l = $('.ladda-button-demo').ladda();

        l.click(function () {
            // Start loading
            l.ladda('start');

            // Timeout example
            // Do something in backend and then stop ladda
            setTimeout(function () {
                l.ladda('stop');
            }, 12000)


        });*/

    });
</script>
</body>
</html>
<?php endif ?>