<?php

use Reagordi\Framework\Web\Asset;

Reagordi::getInstance()->getApplication()->dbInit();

$user = is_auth();

if (!Reagordi::$app->context->request->isAjaxRequest()):
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

        <?= Asset::getInstance()->addCss(TEMPLATE_URL . '/css/bvi.min.css') ?>
        <?= Asset::getInstance()->addCss(TEMPLATE_URL . '/css/bvi-font.min.css') ?>

        <link rel="shortcut icon" href="<?= Asset::getInstance()->addFileUrl(TEMPLATE_URL . '/favicon.ico') ?>"/>

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
    <?php if (defined('RESPONSE_ADMIN') && RESPONSE_ADMIN): ?>
    <div class="topbar" style="position:fixed">

        <!-- LOGO -->
        <div class="topbar-left">
            <div class="text-center">
                <a href="<?= HOME_URL ?>" class="logo">
                    <span><?= Reagordi::getInstance()->getConfig()->get('site_name') ?></span>
                </a>
            </div>
        </div>

        <!-- Button mobile view to collapse sidebar menu -->
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="pull-left">
                    <button class="button-menu-mobile open-left waves-effect waves-light">
                        <i class="md md-menu"></i>
                    </button>
                    <span class="clearfix"></span>
                </div>

                <ul class="nav navbar-nav navbar-right pull-right">
                    <li class="dropdown top-menu-item-xs">
                        <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown"
                           aria-expanded="true"><img src="<?= TEMPLATE_URL ?>/images/users/avatar-1.jpg" alt="user-img"
                                                     class="img-circle"> </a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)"><i class="ti-user m-r-10 text-custom"></i> Profile</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-settings m-r-10 text-custom"></i> Settings</a>
                            </li>
                            <li><a href="javascript:void(0)"><i class="ti-lock m-r-10 text-custom"></i> Lock screen</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="javascript:void(0)"><i class="ti-power-off m-r-10 text-danger"></i> Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<?php else: ?>
    <style>
        .navbar-default .navbar-toggle .icon-bar {
            background-color: #fff;
        }

        .navbar-default .navbar-nav li:hover, .navbar-default .navbar-nav > .active > a:hover {
            background-color: #6e4aab;
        }

        .navbar-default .navbar-nav > .active > a {
            background-color: #5a3992;
        }
    </style>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand и toggle сгруппированы для лучшего отображения на мобильных дисплеях -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= HOME_URL ?>" style="color: #fff; margin-top: 5px;">ГАПОУ КО "КТК"</a>
            </div>

            <!-- Соберите навигационные ссылки, формы, и другой контент для переключения -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php
                    $links = [
                        [
                            'title' => 'Главная',
                            'link' => HOME_URL . '/',
                        ],
                        [
                            'title' => 'Документы для поступления',
                            'link' => HOME_URL . '/dokumenty-dlya-postupleniya.html',
                        ],
                        [
                            'title' => 'Правила приёма',
                            'link' => HOME_URL . '/pravila-priyoma.html',
                        ],
                        [
                            'title' => 'Сроки приёма',
                            'link' => HOME_URL . '/sroki-priyoma.html',
                        ],
                        [
                            'title' => 'Вступительные испытания',
                            'link' => HOME_URL . '/vstupitelnye-ispytaniya.html',
                        ],
                        [
                            'title' => 'Зачисление',
                            'link' => HOME_URL . '/zachislenie.html',
                        ],
                        [
                            'title' => 'Общежитие',
                            'link' => HOME_URL . '/obshhezhitie.html',
                        ],
                        [
                            'title' => 'Контакты',
                            'link' => HOME_URL . '/contact.html',
                        ],
                    ];
                    ?>
                    <?php foreach ($links as $link): ?>
                        <li <?php if (HOME_URL . Reagordi::$app->context->server->getRequestUri() == $link['link']): ?>class="active"<?php endif ?>>
                            <a href="<?= $link['link'] ?>"><?= $link['title'] ?></a></li>
                    <?php endforeach ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if ($user): ?>
                        <a href="<?= HOME_URL ?>/priem/lk.html">
                            <button class="btn btn-success" style="margin-top:13px">Личный кабинет</button>
                        </a>
                        <a href="<?= HOME_URL ?>/priem/lk.html?logout=1">
                            <button class="btn btn-danger" style="margin-top:13px">Выход</button>
                        </a>
                    <?php else: ?>
                        <a href="<?= HOME_URL ?>/login.html">
                            <button class="btn btn-success" style="margin-top:13px">Войти / Подать заявление</button>
                        </a>
                    <?php endif ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
<?php endif ?>
    <?php if (defined('RESPONSE_ADMIN') && RESPONSE_ADMIN): ?>
    <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">
            <div id="sidebar-menu">
                <ul>

                    <li class="has_sub">
                        <a href="<?= HOME_URL . '/' . Reagordi::$app->options->get('url', 'admin_path') ?>"
                           class="waves-effect"><i class="ti-home"></i> <span> Главная</span></a>
                    </li>
                    <li class="has_sub">
                        <a href="<?= HOME_URL . '/' . Reagordi::$app->options->get('url', 'admin_path') ?>/priem/statement.html"
                           class="waves-effect"><i class="ti-home"></i> <span> Заявления</span></a>
                    </li>
                    <li class="has_sub">
                        <a href="<?= HOME_URL . '/' . Reagordi::$app->options->get('url', 'admin_path') ?>/priem/entrant-new.html"
                           class="waves-effect"><i class="ti-home"></i> <span> Новое заявление</span></a>
                    </li>
                    <li class="has_sub">
                        <a href="<?= HOME_URL . '/' . Reagordi::$app->options->get('url', 'admin_path') ?>/priem/rating.html"
                           class="waves-effect"><i class="ti-home"></i> <span> Рейтинг</span></a>
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
    <div class="container content-page"
    style="<?php if (!defined('RESPONSE_ADMIN') || !RESPONSE_ADMIN): ?>margin-left:0<?php else: ?>margin-top:60px;<?php endif ?>">
    <div class="content <?php if (!defined('RESPONSE_ADMIN') || !RESPONSE_ADMIN && (isset($sitebar) && $sitebar)): ?>col-md-9<?php endif ?>">
    <div id="page_context" class="container">
<?php endif ?>
<?php if (isset($conteiner)): ?>
    <?= $conteiner ?>
<?php else: ?>
    <br/>
    <div class="alert alert-danger">Данная страница удаленна или ещё не созданна</div>
<?php endif ?>
<?php if (!Reagordi::$app->context->request->isAjaxRequest()): ?>
    </div>
    </div>
<?php if (!defined('RESPONSE_ADMIN') || !RESPONSE_ADMIN && (isset($sitebar) && $sitebar)): ?>
<div class="col-md-3">
    <div class="text-center">
        <h2>Версия сайта для слабовидящих</h2>
        <a href="#" class="bvi-open" title="Версия сайта для слабовидящих">
            <svg aria-hidden="true" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="bvi-svg-eye" style="width:64px;color:#000"><path fill="currentColor" d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z"></path></svg>
        </a>
    </div>
    <hr />
    <div>
        <h2>ВОПРОСЫ В ПРИЕМНУЮ КОМИССИЮ</h2>
        <p>Секретарь приёмной комиссии</p>
        <p>Михалева Снежана Александровна</p>
        <p><b>Пн — Пт, 08.30 — 16.30</b></p>
        <p>(4842) 52-17-03,</p>
        <p>(4842) 52-18-34</p>
    </div>
    <hr />
    <div>
        <h2>КАК НАС НАЙТИ</h2>
        <p>г. Калуга, ул. Грабцевское шоссе, 126</p><br />
        <p>Микрорайон «Тайфун»</p>
        <p>Маршрутный автобус №77</p>
        <p>Остановка «Лицей №22» (конечная)</p>
        <p>
            <iframe class="yandex_maps" src="https://yandex.ru/map-widget/v1/?um=constructor%3A3a521b07948c9bb78fdd8aa3e2436fbb86af1f7d60dd033f261f839003adb7b3&amp;source=constructor" width="100%" frameborder="0"></iframe>
        </p>
    </div>
</div>
<?php endif ?>
    <footer class="footer text-right"<?php if (!defined('RESPONSE_ADMIN') || !RESPONSE_ADMIN): ?> style="left:0"<?php endif ?>>
        <a href="https://vk.com/rufov" target="_blank">Разработал Руфов Сергей Алексеевич</a> &copy; <?= date('Y') ?>. Все
        права
        защищены
    </footer>

    </div>
    </div>

    <script>var resizefunc = []</script>
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

<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/responsivevoice.min.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/js.cookie.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/js.cookie.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/bvi-init.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/bvi.min.js') ?>

<?= Reagordi::getInstance()->getContext()->getFooter() ?>
    <script>
        $(document).ready(function ($) {
            $('.counter').counterUp({
                delay: 100,
                time: 1200
            });

            $('.ladda-button').ladda();
            try {
                $('.ep_addres').select2({
                    maximumSelectionLength: 2,
                    language: "<?= LANGUAGE_ID ?>"
                });
            } catch (e) {
            }
        });
    </script>
    </body>
    </html>
<?php endif ?>