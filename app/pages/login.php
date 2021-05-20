<?php

/** @var $collector Phroute\Phroute\RouteCollector */

use Reagordi\Framework\Web\View;
use Reagordi\Education\Models\Entrant;

$collector->any('login.html', function () {
    Reagordi::$app->context->setTitle('Вход на сайт');
    Reagordi::$app->context->setDescription('Вход на сайт');

    if (Reagordi::$app->context->session->get('verify_offline') == Reagordi::$app->config->get('education', 'priem', 'key')) {
        header('Location: ' . HOME_URL . '/priem/statement.html');
        exit();
    }

    ob_start();

    if (Reagordi::$app->config->get('education', 'priem', 'start_date') >
        time()) {
        ?>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <br/>
        <h1 class="text-center">Уважаемые абитуриенты!</h1>
        <br/>
        <br/>
        <h3 class="text-center">Подать документы в ГАПОУ КО "КТК" через Личный кабинет абитуриента Вы
            можете</h3>
        <h3 class="text-center">с <?php echo date(
                'd.m.Y: H:i',
                Reagordi::$app->config->get(
                    'education',
                    'priem',
                    'start_date'
                )
            ); ?></h3>
        <h3 class="text-center">до <?php echo date(
                'd.m.Y: H:i',
                Reagordi::$app->config->get(
                    'education',
                    'priem',
                    'end_date'
                )
            ); ?></h3>
    <?php } else { ?>
        <?php
        $error = false;
        if (Reagordi::$app->context->request->getPost('phone') && Reagordi::$app->context->request->getPost('password')) {
            Reagordi::getInstance()->getApplication()->dbInit();
            $user = Entrant::getUser(Reagordi::$app->context->request->getPost('phone'), Reagordi::$app->context->request->getPost('password'));
            if ($user) {
                Reagordi::$app->context->request->cookie->add('phone', Reagordi::$app->context->request->getPost('phone'));
                Reagordi::$app->context->request->cookie->add('password', Reagordi::$app->context->request->getPost('password'));
                header('Location: ' . HOME_URL . '/priem/lk');
                exit();
            }
            $error = true;
        }
        ?>
        <form action="<?= HOME_URL ?>/login.html" method="post" class="form-signin"
              style="width:512px; margin: 0 auto">
            <h2 class="text-center form-signin-heading">Войти в кабинет абитуриента</h2>
            <?php if ($error): ?>
                <div class="alert alert-danger alert-dismissable" style="color: #000">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <b>Не удаётся войти.</b><br>
                    Пожалуйста, проверьте правильность написания <b>номера телефона</b> и <b>пароля</b>.<br>
                    <ul>
                        <li>Возможно, нажата клавиша <b>Caps Lock</b>?</li>
                        <li>Может быть, у Вас включена неправильная <b>раскладка</b>? (русская или английская)</li>
                        <li>Попробуйте набрать свой пароль в текстовом редакторе и <b>скопировать</b> в графу «Пароль»</li>
                    </ul>
                    Если Вы всё внимательно проверили, но войти всё равно не удается, обратитесь к Администратору сайта.
                </div>
            <?php endif ?>
            <div class="form-group">
                <label id="phone">Номер телефона</label>
                <input type="text" name="phone" class="form-control bfh-phone"
                       placeholder="Введите номер телефона"
                       data-format="+7 (ddd) ddd dd - dd" required/>
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
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
