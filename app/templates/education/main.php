<?php

use Reagordi\Framework\Web\Asset;

if ( !Reagordi::$app->context->request->isAjaxRequest() ):
?>
<!DOCTYPE html>
<html lang="<?= LANGUAGE_ID ?>">
<head>
    <?= Reagordi::getInstance()->getContext()->getHead() ?>
<?= Asset::getInstance()->addCss(TEMPLATE_URL . '/plugins/morris/morris.css') ?>
<?= Asset::getInstance()->addCss(TEMPLATE_URL . '/css/bootstrap.min.css') ?>
<?= Asset::getInstance()->addCss(TEMPLATE_URL . '/css/core.css') ?>
<?= Asset::getInstance()->addCss(TEMPLATE_URL . '/css/components.css') ?>
<?= Asset::getInstance()->addCss(TEMPLATE_URL . '/css/icons.css') ?>
<?= Asset::getInstance()->addCss(TEMPLATE_URL . '/css/pages.css') ?>
<?= Asset::getInstance()->addCss(TEMPLATE_URL . '/css/responsive.css') ?>
<?= Asset::getInstance()->addCss(TEMPLATE_URL . '/plugins/fileinput/css/fileinput.css') ?>
<?= Asset::getInstance()->addCss(TEMPLATE_URL . '/plugins/stfileicons/css/stfileicons.css') ?>
<?= Asset::getInstance()->addCss(TEMPLATE_URL . '/plugins/bootstrap-sweetalert/sweet-alert.css') ?>

    <link rel="shortcut icon" href="<?= Asset::getInstance()->addFileUrl( TEMPLATE_URL . '/favicon.ico' ) ?>" />

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
                <?php /*
                <!-- Image Logo here -->
                <!--<a href="index.html" class="logo">-->
                <!--<i class="icon-c-logo"> <img src="assets/images/logo_sm.png" height="42"/> </i>-->
                <!--<span><img src="assets/images/logo_light.png" height="20"/></span>-->
                <!--</a>-->
 */
 ?>
            </div>
        </div>

        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                    <?php if (defined('RESPONSE_ADMIN') && RESPONSE_ADMIN): ?>
                    <div class="pull-left">
                        <button class="button-menu-mobile open-left waves-effect waves-light">
                            <i class="md md-menu"></i>
                        </button>
                        <span class="clearfix"></span>
                    </div>

                    <ul class="nav navbar-nav navbar-right pull-right">
                        <li class="dropdown top-menu-item-xs">
                            <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true"><img src="<?= TEMPLATE_URL ?>/images/users/avatar-1.jpg" alt="user-img" class="img-circle"> </a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)"><i class="ti-user m-r-10 text-custom"></i> Profile</a></li>
                                <li><a href="javascript:void(0)"><i class="ti-settings m-r-10 text-custom"></i> Settings</a></li>
                                <li><a href="javascript:void(0)"><i class="ti-lock m-r-10 text-custom"></i> Lock screen</a></li>
                                <li class="divider"></li>
                                <li><a href="javascript:void(0)"><i class="ti-power-off m-r-10 text-danger"></i> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                    <?php endif ?>
            </div>
        </div>
    </div>
    <?php if (defined('RESPONSE_ADMIN') && RESPONSE_ADMIN): ?>
    <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">
            <div id="sidebar-menu">
                <ul>

                    <li class="has_sub active">
                        <a href="<?= HOME_URL . '/' . Reagordi::$app->options->get('url', 'admin_path') ?>" class="waves-effect active subdrop"><i class="ti-home"></i> <span> Главная</span></a>
                    </li>

                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- Left Sidebar End -->



    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <?php endif ?>
    <div class="content-page"<?php if (!defined('RESPONSE_ADMIN') || !RESPONSE_ADMIN): ?> style="margin-left:0"<?php endif ?>>
        <div class="content">
            <div id="page_context" class="container">
<?php endif ?>
                <?php if ( isset($conteiner) ): ?>
                    <?= $conteiner ?>
                <?php else: ?>
                    <br />
                    <div class="alert alert-danger">Данная страница удаленна или ещё не созданна</div>
                <?php endif ?>
<?php if ( !Reagordi::$app->context->request->isAjaxRequest() ): ?>
            </div>
        </div>
        <footer class="footer text-right"<?php if (!defined('RESPONSE_ADMIN') || !RESPONSE_ADMIN): ?> style="left:0"<?php endif ?>>
            <a href="/"><?= Reagordi::getInstance()->getConfig()->get('site_name') ?></a> &copy; <?= date('Y') ?>. Все права защищены
        </footer>

    </div>
</div>

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
    });
</script>
</body>
</html>
<?php endif ?>