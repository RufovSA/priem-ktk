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

$collector->any(
  'priem/statement.html',
  function () {
    Reagordi::$app->context->setTitle(t('Application submission'));
    Reagordi::$app->context->setDescription(t('Application submission'));

    ob_start();
?>
dfsdsfdsf
<?php
    Reagordi::$app->context->view->assign('conteiner', ob_get_clean());

    return Reagordi::$app->context->view->fech();
  }
);
