<?php

/** @var $collector Phroute\Phroute\RouteCollector */

use Reagordi\Framework\Web\View;

$collector->any('', function () {
    Reagordi::$app->context->setTitle('Главная');
    Reagordi::$app->context->setDescription('Описание главной страницы');

    if (Reagordi::$app->context->session->get('verify_offline') == Reagordi::$app->config->get('education', 'priem', 'key')) {
        header('Location: ' . HOME_URL . '/priem/statement.html');
        exit();
    }

    ob_start();

    if (Reagordi::$app->config->get('education', 'priem', 'start_date') >
        time()) {
        ?>
        <br/>
        <h1 class="text-center">Уважаемые абитуриенты!</h1>
        <h3>Подать документы в ГАПОУ КО КТК через Личный кабинет абитуриента Вы
            можете:</h3>
        <h3>с <?php echo date(
                'd.m.Y: H:i',
                Reagordi::$app->config->get(
                    'education',
                    'priem',
                    'start_date'
                )
            ); ?></h3>
        <h3>до <?php echo date(
                'd.m.Y: H:i',
                Reagordi::$app->config->get(
                    'education',
                    'priem',
                    'end_date'
                )
            ); ?></h3>
    <?php } else { ?>
        <form action="<?= HOME_URL ?>" method="post" class="form-signin"
              style="width:512px; margin: 0 auto">
            <h2 class="text-center form-signin-heading">Войти в кабинет абитуриента:</h2>
            <div class="form-group">
                <label id="phone">Номер телефона</label>
                <input type="text" name="phone" class="form-control bfh-phone"
                       placeholder="Введите номер телефона"
                       data-format="+7 (ddd) ddd dd - dd" required/>
            </div>
            <div class="form-group">
                <label for="passport">Пароль</label>
                <input type="password" id="password" name="password"
                       class="form-control" placeholder="Пароль"
                        required/>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
            <br/>
            <a href="<?= HOME_URL ?>/priem/statement.html" style="text-decoration: none">
                <button class="btn btn-lg btn-success btn-block" type="button">Подать
                    заявление
                </button>
            </a>
            <div>
                <?php Reagordi::$app->context->components->includeComponent(
                    'reagordi:social',
                    'auth',
                    'defalut',
                    array(
                        'page_url' => HOME_URL . '/priem/statement.html'
                    ),
                    false
                ) ?>
            </div>
        </form>
        <?php
    }
    View::getInstance()->assign('conteiner', ob_get_clean());

    return View::getInstance()->fech();
});
