<?php

/** @var $collector Phroute\Phroute\RouteCollector */

use Reagordi\Framework\Config\Config;
use Reagordi\Framework\Web\View;

$collector->get(
  '',
  function () {
    Reagordi::getInstance()->getContext()->setTitle('Главная');
    Reagordi::getInstance()->getContext()->setDescription('Описание главной страницы');

    ob_start();

    if (Reagordi::getInstance()->getConfig()->get('education', 'priem', 'start_date') >
      time()) {
      ?>
        <br/>
        <h1 class="text-center">Уважаемые абитуриенты!</h1>
        <h3>Подать документы в ГАПОУ КО КТК через Личный кабинет абитуриента Вы
            можете:</h3>
        <h3>с <?php echo date(
            'd.m.Y: H:i',
            Config::getInstance()->get(
              'education',
              'priem',
              'start_date'
            )
          ); ?></h3>
        <h3>до <?php echo date(
            'd.m.Y: H:i',
            Config::getInstance()->get(
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
                <label for="passport">Серия и номер паспорта</label>
                <input type="text" id="passport" name="passport"
                       class="form-control bfh-phone" placeholder="Серия и номер паспорта"
                       data-format="dd dd dddddd" required/>
            </div>
            <div class="form-group">
                <input type="checkbox" id="remember_me" value="remember_me" value="1"/>
                <label for="remember_me">Запомнить меня</label>
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
  }
);
