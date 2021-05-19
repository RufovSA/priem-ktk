<?php

/** @var $collector Phroute\Phroute\RouteCollector */

$collector->any('pravila-priyoma.html', function () {
    Reagordi::$app->context->setTitle('Правила приёма');
    Reagordi::$app->context->setDescription('Правила приёма');

    ob_start();
    ?>
    <div class="card-box table-responsive">
        <p><a href="https://ktk40.ru/sveden_ob_org/3_3_documents/pologenie/2020/o_priem_komiss_20-21.pdf"
              target="_blank" rel="noopener noreferrer">Положение о приемной комиссии ГАПОУ КО «КТК»</a></p>
        <p><a title="Правила приема в ГАПОУ КО &quot;КТК&quot; на 2021-2022 гг."
              href="https://ktk40.ru/sveden_ob_org/3_3_documents/pologenie/2020/prav_priem/21-22.pdf" target="_blank"
              rel="noopener noreferrer">Правила приема в ГАПОУ КО «КТК» на 2021-2022 гг.</a></p>
        <h3>Как к нам поступить</h3>
    </div>
    <div class="tabs-vertical-env">
        <ul class="nav tabs-vertical">
            <li class="active">
                <a href="#vmy-tab-1" data-toggle="tab">Шаг 1</a>
            </li>
            <li>
                <a href="#vmy-tab-2" data-toggle="tab">Шаг 2</a>
            </li>
            <li>
                <a href="#vmy-tab-3" data-toggle="tab">Шаг 3</a>
            </li>
            <li>
                <a href="#vmy-tab-4" data-toggle="tab">Шаг 4</a>
            </li>
        </ul>
        <div class="tab-content" style="width:100%">
            <div class="tab-pane active" id="vmy-tab-1">
                <h3 style="text-align: center;"><strong>ВЫБИРАЕМ СПОСОБ ПОДАЧИ ДОКУМЕНТОВ</strong></h3>
                <p style="text-align: left;"><strong>Документы можно подать следующими способами:</strong></p>

                <ol>
                    <li><u>Самый предпочтительный способ</u>.
                        В электронной форме (документ на бумажном носителе, преобразованный в электронную форму путём
                        сканирования или фотографирования с обеспечением машиночитаемого распознавания его реквизитов):
                        посредством электронной почты организации (<a href="mailto:priem.ktk@yandex.ru">priem.ktk@yandex.ru</a>)
                    </li>
                    <li>Через операторов почтовой связи общего доступа &nbsp;по адресу:
                        248009, Калужская область, г. Калуга, ул. Грабцевское шоссе, д. 126
                    </li>
                    <li>С использованием функционала (сервисов) региональных порталов государственных и муниципальных
                        услуг (ГОСУСЛУГИ)
                        <a href="https://entry.admoblkaluga.ru/" target="_blank" rel="noopener">https://entry.admoblkaluga.ru/</a>
                    </li>
                </ol>
            </div>
            <div class="tab-pane" id="vmy-tab-2">
                <h3 style="text-align: center;"><strong>Заполняем бланки</strong></h3>
                При подаче документов по почте РФ необходимо предоставить следующие документы:
                <ol>
                    <li>Заполненный бланк заявления.<strong>(</strong><a
                                href="<?= HOME_URL ?>/uploads/obrazecz-zayavleniya-o-priyome.pdf">Образец</a> и <a
                                href="<?= HOME_URL ?>/uploads/zayavlenie-o-prieme-spo.docx">бланк
                            заявления</a><strong>)</strong></li>
                    <li>Заполненное согласие на обработку персональных данных&nbsp; (заполняется одним из родителей).
                        Для несовершеннолетних <strong>(</strong><a
                                href="<?= HOME_URL ?>/uploads/obrazczy-zapolneniya-soglasij.pdf">Образец</a> и <a
                                href="<?= HOME_URL ?>/uploads/soglasie-na-obrabotku-personalnyh-dannyh-podopechnogo.docx">бланк
                            согласия</a><strong>).
                        </strong>Для совершеннолетних <strong>(</strong><a
                                href="<?= HOME_URL ?>/uploads/obrazczy-zapolneniya-soglasij-1.pdf">Образец</a> и <a
                                href="<?= HOME_URL ?>/uploads/soglasie-na-obrabotku-personalnyh-dannyh-sovershennoletnego.docx">бланк
                            согласия</a><strong>).</strong></li>
                    <li>Одну ксерокопию документа, удостоверяющего личность и гражданство (паспорт) <strong>стр. 2-3,
                            5.</strong></li>
                    <li>Оригинал или ксерокопию документа об образовании (аттестат об окончании 9-го или 11-го класса)
                    </li>
                    <li>4 фотографии размером 3*4</li>
                    <li>Все документы вкладываем в файл</li>
                    <li>Отправляете документы по почте.</li>
                </ol>
                <strong><u>Соблюдайте меры предосторожности, а именно: </u></strong>

                <strong>наличие&nbsp; маски, перчаток,&nbsp; дистанция&nbsp; 2 метра между посетителями!</strong>
            </div>
            <div class="tab-pane" id="vmy-tab-3">
                <h3 style="text-align: center;"><strong>Отправляем удобным способом</strong></h3>
                После получения заявления о приёме&nbsp; приемная комиссия&nbsp; в электронной форме или с помощью
                операторов почтовой связи общего пользования информирует поступающего о необходимости для зачисления в
                организацию предоставить уведомление о намерении обучаться и о сроках его представления. Уведомление
                <strong>(<a href="<?= HOME_URL ?>/uploads/uvedomlenie-o-namerenii-obuchatsya.pdf">Бланк
                        уведомления</a></strong>) о намерении обучаться подаётся поступающим&nbsp; по электронной почте
                <strong>(</strong><a href="mailto:priem.ktk@yandex.ru"><strong>priem</strong><strong>.</strong><strong>ktk</strong><strong>@</strong><strong>yandex</strong><strong>.</strong><strong>ru</strong></a><strong>)</strong>
            </div>
            <div class="tab-pane" id="vmy-tab-4">
                <h3 style="text-align: center;"><strong>Зачисление</strong></h3>
                Зачисление абитуриентов производится на конкурсной основе только по результатам среднего балла аттестата
                и при наличии в приемной комиссии оригинала или уведомления о намерении обучаться с личной подписью.
            </div>
        </div>
    </div>
    <?php
    Reagordi::$app->context->view->assign('sitebar', true);
    Reagordi::$app->context->view->assign('conteiner', ob_get_clean());

    return Reagordi::$app->context->view->fech();
});