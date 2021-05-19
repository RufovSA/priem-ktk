<?php

/** @var $collector Phroute\Phroute\RouteCollector */

$collector->any('obshhezhitie.html', function () {
    Reagordi::$app->context->setTitle('Общежитие');
    Reagordi::$app->context->setDescription('Общежитие');

    ob_start();
    ?>
    <div class="card-box table-responsive">
        <p>Общежитие предоставляется следующим категориям абитуриентов:</p>
        <p>— детям сиротам</p>
        <p>— детям&nbsp; инвалидам</p>
        <p>—&nbsp; детям прописанным на территории Чернобыльской зоны (наличие&nbsp; справки о прописке в ЧЗ).</p>
        <p>Так же общежитие предоставляется абитуриентам поступающим на специальность «Технология машиностроения».</p>

        <p>Для абитуриентов, которым предоставляется общежитие &nbsp;дополнительно необходимо оформить медицинскую справку М-086у.</p>
        <p><a href="<?= HOME_URL ?>/uploads/zayavlenie-na-obshhezhitie.docx" target="_blank" rel="noreferrer noopener">Заявление на предоставление общежития</a></p>
    </div>
    <?php
    Reagordi::$app->context->view->assign('sitebar', true);
    Reagordi::$app->context->view->assign('conteiner', ob_get_clean());

    return Reagordi::$app->context->view->fech();
});