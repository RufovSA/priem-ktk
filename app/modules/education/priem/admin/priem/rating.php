<?php
/**
 * Reagordi CMS Generator
 *
 * @package reagordi/cms
 * @subpackage generate-page
 * @copyright Reagordi (c) 2020
 * @create-date 01.02.2021 10:53:12
 */

/** @var $collector Phroute\Phroute\RouteCollector */

$collector->get(
    'priem/rating.html',
    function () {
        Reagordi::$app->context->setTitle('Рейтинг');
        Reagordi::$app->context->setDescription('Рейтинг');

        if (Reagordi::$app->context->request->cookie->get('verify_offline') != Reagordi::$app->config->get('education', 'priem', 'key')) {
            header('Location: /');
            exit();
        }

        ob_start();
        ?>
<div class="card-box table-responsive">
        <?php Reagordi::$app->context->components->includeComponent(
            'education:priem',
            'rating',
            'defalut',
            array(),
            false
        ); ?>
</div>
<?php
        Reagordi::$app->context->view->assign('conteiner', ob_get_clean());


        return Reagordi::$app->context->view->fech();
    }
);