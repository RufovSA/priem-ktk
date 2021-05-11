<?php
use Reagordi\Framework\Web\Asset;

/** @var string $url */
/** @var bool $error */

?>
<!DOCTYPE html>
<html lang="<?= LANGUAGE_ID ?>">
<head>
    <?= Reagordi::getInstance()->getContext()->getHead() ?>

    <?= Asset::getInstance()->addCss(TEMPLATE_URL . '/css/bootstrap.min.css') ?>
    <?= Asset::getInstance()->addCss(TEMPLATE_URL . '/css/core.css') ?>
    <?= Asset::getInstance()->addCss(TEMPLATE_URL . '/css/components.css') ?>
    <?= Asset::getInstance()->addCss(TEMPLATE_URL . '/css/icons.css') ?>
    <?= Asset::getInstance()->addCss(TEMPLATE_URL . '/css/pages.css') ?>
    <?= Asset::getInstance()->addCss(TEMPLATE_URL . '/css/responsive.css') ?>

    <link rel="shortcut icon" href="<?= Asset::getInstance()->addFileUrl( TEMPLATE_URL . '/favicon.ico' ) ?>" />
</head>
<body>

<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
    <div class=" card-box">
        <div class="panel-heading">
            <h3 class="text-center"><?= Reagordi::getInstance()->getConfig()->get('site_name') ?></h3>
        </div>


        <div class="panel-body">
            <?php if ($error): ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <div class="msg_text"><b>Не удаётся войти.</b> <br>Пожалуйста, проверьте правильность написания <b>логина</b> и <b>пароля</b>.
                    <ul class="listing">
                        <li><span>Возможно, нажата клавиша <b>Caps Lock</b>?</span></li>
                        <li><span>Может быть, у Вас включена неправильная <b>раскладка</b>? (русская или английская)</span></li>
                        <li><span>Попробуйте набрать свой пароль в текстовом редакторе и <b>скопировать</b> в графу «Пароль»</span></li>
                    </ul>
                    Если Вы всё внимательно проверили, но войти всё равно не удаётся, Вы можете <b><a href="<?= add_query_arg('act', 'restore', $url) ?>">нажать сюда</a></b>.</div>
            </div>
            <?php endif ?>

            <?php if (Reagordi::$app->context->request->get('logout') == '1'): ?>
                <div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Вы успешно вышли
                </div>
            <?php endif ?>

            <form class="form-horizontal" method="post" action="<?= $url ?>">
                <?php if (Reagordi::$app->context->request->get('act') == 'reg' && Reagordi::$app->options->get('components', 'user', 'reg') === true): ?>
                    <input type="hidden" name="act" value="reg" />

                <?php elseif (Reagordi::$app->context->request->get('act') == 'restore'): ?>
                    <input type="hidden" name="act" value="restore" />
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" name="login" required="" placeholder="E-Mail" />
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <div class="col-xs-12">
                            <button class="btn btn-default btn-block text-uppercase waves-effect waves-light" type="submit">Востановить пароль</button>
                        </div>
                    </div>

                    <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <a href="<?= add_query_arg('act', 'login', $url) ?>" class="text-dark">Войти</a>
                        </div>
                    </div>

                <?php else: ?>
                <input type="hidden" name="act" value="login" />
                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="text" name="login" required="" placeholder="Логин или E-Mail" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input class="form-control" type="password" name="password" required="" placeholder="Пароль" />
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <div class="checkbox checkbox-purple">
                            <input id="checkbox-signup" type="checkbox" name="remember_me" />
                            <label for="checkbox-signup">Запомнить меня</label>
                        </div>
                    </div>
                </div>

                <div class="form-group text-center">
                    <div class="col-xs-12">
                        <button class="btn btn-default btn-block text-uppercase waves-effect waves-light" type="submit">Войти</button>
                    </div>
                </div>

                <div class="form-group m-b-0">
                    <div class="col-sm-12">
                        <a href="<?= add_query_arg('act', 'restore', $url) ?>" class="text-dark"><i class="fa fa-lock m-r-5"></i> Забыли пароль?</a>
                    </div>
                </div>
                <?php endif ?>
            </form>

        </div>
    </div>

    <?php if (Reagordi::$app->options->get('components', 'user', 'reg') === true): ?>
    <div class="row">
        <div class="col-sm-12 text-center">
            <p>
                <a href="<?= add_query_arg('act', 'reg', $url) ?>" class="text-primary m-l-5">Зарегистрироваться</a>
            </p>
        </div>
    </div>
    <?php endif ?>

    <div class="row">
        <div class="col-sm-12 text-center">
            <p>
                <a href="<?= HOME_URL ?>" class="text-primary m-l-5">&laquo; Обратнго к сайту "<?= Reagordi::$app->config->get('site_name') ?>"</a>
            </p>
        </div>
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


<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/jquery.core.js') ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/jquery.app.js') ?>

<?= Reagordi::getInstance()->getContext()->getFooter() ?>

</body>
</html>