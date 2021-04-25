<?php
/** @var int $act */
/** @var int $verify */
/** @var array $list_priem */
/** @var string $page_url */

/** @var array $error */

use Reagordi\Framework\Web\Asset;

$sessions = Reagordi::$app->context->session;

Asset::getInstance()->addCss(
    'https://snipp.ru/cdn/select2/4.0.13/dist/css/select2.min.css',
    100
);
Asset::getInstance()->addJs(
    'https://snipp.ru/cdn/select2/4.0.13/dist/js/select2.min.js',
    100
);
Asset::getInstance()->addJs(
    'https://snipp.ru/cdn/select2/4.0.13/dist/js/i18n/ru.js',
    100
);
//\Reagordi\Framework\Web\Asset::getInstance()->addJs('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js', 100);
?>
<div class="col-sm-8">
    <div class="panel panel-custom">
        <div class="panel-heading" style="color:#fff"><?php if (isset(
                $list_priem[$act -
                1]
            )): ?><?= $list_priem[$act - 1] ?><?php endif ?></div>
        <div class="panel-body">
            <?php if ($error): ?>
                <div class="alert alert-danger" role="alert">
                    <button type="button" class="close" data-dismiss="alert"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul>
                        <?php foreach ($error as $err): ?>
                            <li><?= $err ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>
            <form id="ed_statement_form" action="<?= $page_url ?>" method="post"
                  enctype="multipart/form-data" onsubmit="ep_form(this);return false;">
                <input type="hidden" id="rg_ep_sid" name="sid"
                       value="<?= isset($_COOKIE[RG_COOKIE_SID]) ?
                           $_COOKIE[RG_COOKIE_SID] :
                           Reagordi::$app->context->session->sid ?>"/>
                <input type="hidden" id="rg_ep_act" name="act" value="<?= $act + 1 ?>"/>

                <?php
                if (is_file(__DIR__ . '/include/step_' . $act . '.php')) {
                    require_once __DIR__ . '/include/step_' . $act . '.php';
                }
                ?>

                <section class="progress-demo">
                    <?php if ($act > 1): ?>
                        <div class="form-group col-md-6">
                            <a href="<?= $page_url ?>?act=<?= $act - 1 ?>"
                               onclick="ep_back('<?= $page_url ?>', '<?= $act -
                               1 ?>', '<?= isset($_COOKIE[RG_COOKIE_SID]) ?
                                   $_COOKIE[RG_COOKIE_SID] :
                                   Reagordi::$app->context->session->sid ?>');return false;"
                               style="text-decoration: none">
                                <button id="ep_but_back" type="button"
                                        class="ladda-button btn btn-primary"
                                        style="width: 100%" data-style="expand-right">
                                  <span class="ladda-label"><?= Reagordi::$app->context->i18n->getMessage(
                                          'rg_ep_back'
                                      ) ?></span>
                                </button>
                            </a>
                        </div>
                    <?php endif ?>
                    <div class="form-group col-md-<?php if ($act ==
                        1): ?>12<?php else: ?>6<?php endif ?>">
                        <button id="ep_but_next" class="ladda-button btn btn-default"
                                style="width: 100%" data-style="expand-right">
                            <span class="ladda-label"><?php if (count($list_priem) ==
                                    $act): ?><?= Reagordi::$app->context->i18n->getMessage(
                                    'rg_ep_complete'
                                ) ?><?php else: ?><?= Reagordi::$app->context->i18n->getMessage(
                                    'rg_ep_further'
                                ) ?><?php endif ?></span>
                        </button>
                    </div>
                </section>
            </form>
            <?php if ($verify): ?>
            <div class="text-right">
                <i class="fa fa-check" style="color:#21921a;font-size:24px"></i> Заявление заполняется в учебном заведении
            </div>
            <?php endif ?>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <ul class="list-group">
        <?php for ($i = 1; $i <= count($list_priem); $i++): ?>
            <li class="list-group-item<?php if ($i == $act): ?> active<?php elseif ($act >
                $i): ?> disabled<?php endif ?>"><?= $i ?>. <?= $list_priem[$i - 1] ?></li>
        <?php endfor ?>
    </ul>
</div>