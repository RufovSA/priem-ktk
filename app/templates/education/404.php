<?php
use Reagordi\Framework\Web\Asset;

Reagordi::$app->context->setTitle( '404 Not Found' );
Reagordi::$app->context->setDescription( '404 Not Found' );
Reagordi::$app->context->setRobots( 'noindex,follow' );
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?= Reagordi::getInstance()->getContext()->getHead() ?>

    <link rel="shortcut icon" href="<?= Asset::getInstance()->addFileUrl( TEMPLATE_URL . '/favicon.ico' ) ?>" />

    <?= Asset::getInstance()->addCss(TEMPLATE_URL . '/css/bootstrap.min.css' ) ?>
    <?= Asset::getInstance()->addCss(TEMPLATE_URL . '/css/core.css' ) ?>
    <?= Asset::getInstance()->addCss(TEMPLATE_URL . '/css/components.css' ) ?>
    <?= Asset::getInstance()->addCss(TEMPLATE_URL . '/css/icons.css' ) ?>
    <?= Asset::getInstance()->addCss(TEMPLATE_URL . '/css/pages.css' ) ?>
    <?= Asset::getInstance()->addCss(TEMPLATE_URL . '/css/responsive.css' ) ?>

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="account-pages"></div>
<div class="clearfix"></div>

<div class="wrapper-page">
    <div class="ex-page-content text-center">
        <div class="text-error"><span class="text-primary">4</span><i class="ti-face-sad text-pink"></i><span class="text-info">4</span></div>
        <h2>Упс! Страница не найдена</h2>
        <p class="text-muted">Эта страница не может быть найдена или отсутствует.</p>
        <a class="btn btn-default waves-effect waves-light" href="<?= HOME_URL ?>"> На главную</a>

    </div>
</div>


<script>var resizefunc=[]</script>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/modernizr.min.js' ) ?>
<!-- jQuery  -->
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/jquery.min.js' ) ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/bootstrap.min.js' ) ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/detect.js' ) ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/fastclick.js' ) ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/jquery.slimscroll.js' ) ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/jquery.blockUI.js' ) ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/waves.js' ) ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/jquery.nicescroll.js' ) ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/jquery.nicescrollnicescroll.min.js' ) ?>

<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/jquery.core.js' ) ?>
<?= Asset::getInstance()->addJs(TEMPLATE_URL . '/js/jquery.app.js' ) ?>
</body>
</html>