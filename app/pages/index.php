<?php

/** @var $collector Phroute\Phroute\RouteCollector */

$collector->any('', function () {
    Reagordi::$app->context->setTitle('Главная');
    Reagordi::$app->context->setDescription('Описание главной страницы');

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
		
		<h4 style="text-align: center;"><span style="color: #ff0000;">Уважаемые абитуриенты!</span></h4>
		<h4>Объявляется набор на заочное отделение</h4>
		<h4>на 2021/2022 учебный год.</h4>
		<p><strong><em>по специальности: «Технология машиностроения»</em></strong></p>
		<p><strong><em>&nbsp;на базе 11 классов</em></strong></p>
		<p><strong><em>(обучение платное)</em></strong></p>
		<h4><u>Преимущества обучения по заочной форме:</u></h4>
		<ul>
<li>По окончанию обучения выдается диплом государственного образца с присвоением квалификации «техник»</li>
<li>5 учебных недель в учебном году</li>
<li>Возможность обучения без отрыва от производства</li>
<li>На период сессии студенту выдается справка-вызов, которая является основанием для предоставления студенту учебного оплачиваемого отпуска работодателем.</li>
</ul>
<p><strong><em>По всем вопросам обращаться</em></strong><strong><em>: </em></strong></p>
<p>Мольков В.В.(заместитель директора, начальник отделения) телефон (4842) 55-00-45</p>
<p>Коломыцына А.В. телефон 8-953-328-47-86</p>
    </div>
<?php
    Reagordi::$app->context->view->assign('sitebar', true);
    Reagordi::$app->context->view->assign('conteiner', ob_get_clean());

    return Reagordi::$app->context->view->fech();
});