<?php

use Reagordi\Framework\Loader;
use Reagordi\GeoVk\Cities;
use Reagordi\GeoVk\Countries;
use Reagordi\GeoVk\Regions;
use Dompdf\Dompdf;

function getEntrant($session) {
    \Dompdf\Autoloader::register();

    ob_start();

    $sum = 0;
    $c = 0;
    foreach (Reagordi::$app->context->session->get('school_subject') as $school_subject) {
        if ($school_subject['name'] && $school_subject['estimation']) {
            $sum += $school_subject['estimation'];
            $c++;
        }
    }
    $bal = $sum / $c;
    unset($school_subject, $sum, $c);

    $passport_date = new DateTime(Reagordi::$app->context->session->get('passport_date'));
    $bdate = new DateTime(Reagordi::$app->context->session->get('bdate'));

    $age = false;
    $_t = date('Y', $bdate->getTimestamp());
    if (date('Y') - $_t >= 18) $age = true;
    unset($_t);

    $citizenship = [
        1 => 'РФ',
        'Гражданин РФ и иностранного государства (двойное гражданство)',
        'Иностранный гражданин',
        'Лицо без гражданства'
    ];

    $type_doc = [
        1 => 'Паспорт гражданина РФ',
        'Паспорт иностранного гражданина',
        'Временное убежище',
        'Удостоверение личности гражданина РФ в виде пластиковой карты',
        'Свидетельство о рождении',
        'Вид на жительство',
        'Временное удостоверение личности гражданина РФ',
        'Заграничный паспорт гражданина РФ'
    ];

    $status = array(
        'Законный представитель',
        'Мать',
        'Отец',
        'Бабушка',
        'Дедушка',
    );

    $nc = new \NCLNameCaseRu();
    ?>
    <!DOCTYPE html>
    <html lang="<?= LANGUAGE_ID ?>">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
        <title></title>
        <style>
            body {
                font-size: 12px;
                font-family: DejaVu Sans
            }

            table {
                width: 100%
            }

            table td {
                vertical-align: top;
                padding: 2px
            }
        </style>
    </head>
    <body>
    <p align="center">
        <b><?= Reagordi::$app->config->get('education', 'priem', 'company_name') ?></b>
    </p>
    <p align="right"><b>Регистрационный номер</b>: <?= date('Y') ?>
        _<?= Reagordi::$app->context->session->get('user_id') ?></p>
    <table width="100%" cellpadding="0" cellspacing="0" border="1">
        <tr>
            <td style="width: 25%">
                <b>Фамилия</b>
            </td>
            <td style="width: 25%"><?= Reagordi::$app->context->session->get('last_name') ?></td>
            <td>
                <b>Гражданство</b>
            </td>
            <td><?= $citizenship[Reagordi::$app->context->session->get('citizenship')] ?></td>
        </tr>
        <tr>
            <td>
                <b>Имя</b>
            </td>
            <td><?= Reagordi::$app->context->session->get('first_name') ?></td>
            <td colspan="2">
                <b>Документ, удостоверяющий личность</b>
            </td>
        </tr>
        <tr>
            <td>
                <b>Отчество</b>
            </td>
            <td><?= Reagordi::$app->context->session->get('middle_name') ?></td>
            <td colspan="2"><?= $type_doc[Reagordi::$app->context->session->get('type_doc')] ?></td>
        </tr>
        <tr>
            <td>
                <b>Дата рождения</b>
            </td>
            <td><?= date('d.m.Y', $bdate->getTimestamp()) ?></td>
            <td colspan="2"><b>Серия</b> <?= Reagordi::$app->context->session->get('series_passport') ?>
                <b>№</b> <?= Reagordi::$app->context->session->get('number_passport') ?></td>
        </tr>
        <tr>
            <td>
                <b>Место рождения</b>
            </td>
            <td><?= Reagordi::$app->context->session->get('place_birth') ?></td>
            <td colspan="2"><b>Когда и кем выдан</b> <?= date('d.m.Y', $passport_date->getTimestamp()) ?>
                <br/><?= Reagordi::$app->context->session->get('passport_whom') ?>
                <br/><?= Reagordi::$app->context->session->get('division_code') ?></td>
        </tr>
        <tr>
            <td>
                <b>Телефон</b>
            </td>
            <td><?= Reagordi::$app->context->session->get('phone') ?></td>
            <td>
                <b>E-Mail</b>
            </td>
            <td><?= Reagordi::$app->context->session->get('email') ?></td>
        </tr>
    </table>
    <p><b>Адрес постоянной прописки</b>: <u>
            <?php
            $addres = '';
            if (Reagordi::$app->context->session->has('checkbox_addres_pass_noselect')) {
                $addres = Reagordi::$app->context->session->get('addres_passport_noselect');
            } else {
                foreach (Countries::getList() as $d) {
                    if ($d['id'] == Reagordi::$app->context->session->get('addres_passport_country')) {
                        $addres .= $d['title'] . ', ';
                        break;
                    }
                }
                foreach (Regions::getList(Reagordi::$app->context->session->get('addres_passport_country')) as $d) {
                    if ($d['id'] == Reagordi::$app->context->session->get('addres_passport_region')) {
                        $addres .= $d['title'] . ', ';
                        break;
                    }
                }
                foreach (Cities::getList(Reagordi::$app->context->session->get('addres_passport_country'), Reagordi::$app->context->session->get('addres_passport_region')) as $d) {
                    if ($d['id'] == Reagordi::$app->context->session->get('addres_passport_city')) {
                        if (isset($d['area'])) echo $d['area'] . ', ';
                        $addres .= $d['title'] . ', ';
                        break;
                    }
                }
                $addres .= 'ул. ' . Reagordi::$app->context->session->get('addres_passport_street') . ', ';
                $addres .= 'д. ' . Reagordi::$app->context->session->get('addres_passport_house');
                if (Reagordi::$app->context->session->get('addres_passport_body')) $addres .= ', кор. ' . Reagordi::$app->context->session->get('addres_passport_body');
                if (Reagordi::$app->context->session->get('addres_passport_flat')) $addres .= ', кор. ' . Reagordi::$app->context->session->get('addres_passport_flat');
            }
            echo $addres;
            ?>
        </u>
    </p>
    <?php if (Reagordi::$app->context->session->has('checkbox_addres_fact')): ?>
        <p><b>Адрес фактического проживания</b>: <u>
                <?php
                if (Reagordi::$app->context->session->has('checkbox_addres_fact_noselect')) {
                    echo Reagordi::$app->context->session->get('addres_fact_noselect');
                } else {
                    foreach (Countries::getList() as $d) {
                        if ($d['id'] == Reagordi::$app->context->session->get('addres_fact_country')) {
                            echo $d['title'] . ', ';
                            break;
                        }
                    }
                    foreach (Regions::getList(Reagordi::$app->context->session->get('addres_fact_country')) as $d) {
                        if ($d['id'] == Reagordi::$app->context->session->get('addres_fact_region')) {
                            echo $d['title'] . ', ';
                            break;
                        }
                    }
                    foreach (Cities::getList(Reagordi::$app->context->session->get('addres_fact_country'), Reagordi::$app->context->session->get('addres_fact_region')) as $d) {
                        if ($d['id'] == Reagordi::$app->context->session->get('addres_fact_city')) {
                            if (isset($d['area'])) echo $d['area'] . ', ';
                            echo $d['title'] . ', ';
                            break;
                        }
                    }
                    echo 'ул. ' . Reagordi::$app->context->session->get('addres_fact_street') . ', ';
                    echo 'д. ' . Reagordi::$app->context->session->get('addres_fact_house');
                    if (Reagordi::$app->context->session->get('addres_fact_body')) echo ', кор. ' . Reagordi::$app->context->session->get('addres_fact_body');
                    if (Reagordi::$app->context->session->get('addres_fact_flat')) echo ', кор. ' . Reagordi::$app->context->session->get('addres_fact_flat');
                }
                ?>
            </u>
        </p>
    <?php endif ?>
    <p align="center"><b>ЗАЯВЛЕНИЕ</b></p>
    <p>Прошу принять меня на обучение по следующим программам обучения</p>
    <table width="100%" cellpadding="0" cellspacing="0" border="1">
        <tr>
            <th>Специальность/Профессия</th>
            <th>Форма обучения</th>
            <th>Вид финансирования</th>
        </tr>
        <tr>
            <td><?= Reagordi::$app->context->session->get('specialtie1') ?></td>
            <td>Очная форма обучения</td>
            <td>Бюджетное финансирование</td>
        </tr>
        <?php if (Reagordi::$app->context->session->get('specialtie2') && Reagordi::$app->context->session->get('specialtie2') != 'Выбор специальности'): ?>
            <tr>
                <td><?= Reagordi::$app->context->session->get('specialtie2') ?></td>
                <td>Очная форма обучения</td>
                <td>Бюджетное финансирование</td>
            </tr>
        <?php endif ?>
        <?php if (Reagordi::$app->context->session->get('specialtie3') && Reagordi::$app->context->session->get('specialtie3') != 'Выбор специальности'): ?>
            <tr>
                <td><?= Reagordi::$app->context->session->get('specialtie3') ?></td>
                <td>Очная форма обучения</td>
                <td>Бюджетное финансирование</td>
            </tr>
        <?php endif ?>
    </table>
    <p><b>О себе сообщаю следующие:</b></p>
    <p>
        Окончил<?php if (Reagordi::$app->context->session->get('sex') == '2'): ?>а<?php endif ?>
        <u><?= Reagordi::$app->context->session->get('name_edu') ?></u> в
        <u><?= Reagordi::$app->context->session->get('year_edu') ?></u> году</p>
    <p>
        <b>
            <?php if (Reagordi::$app->context->session->get('type_doc_edu') == '1'): ?>
                Аттестат (9 Кл.)
            <?php else: ?>
                Аттестат (11 Кл.)
            <?php endif ?>
            №
        </b>
        <u><?= Reagordi::$app->context->session->get('edu_series_num') ?></u>
    </p>
    <?php if ($bal == 5): ?>
        <p><u>Имеею медаль (<?php if (Reagordi::$app->context->session->get('type_doc_edu') == '1'): ?>
                    Аттестат (9 Кл.)
                <?php else: ?>
                    Аттестат (11 Кл.)
                <?php endif ?>) с «отличием»</u></p>
    <?php endif ?>
    <?php if (Reagordi::$app->context->session->has('checkbox_olimpiada')): ?>
        <p><u>Являюсь победителем всероссийских олимпиад (член сборной)</u></p>
    <?php endif ?>
    <?php if (Reagordi::$app->context->session->has('checkbox_obsaga')): ?>
        <p><u>Нуждаюсь в общежитие</u></p>
    <?php endif ?>
    <p><b>Иностранный язык</b>: <u><?= Reagordi::$app->context->session->get('foreign_language') ?></u></p>
    <?php if (Reagordi::$app->context->session->get('benefits')): ?>
        <p><b>При поступлении имею следующие льготы</b>: <u><?= Reagordi::$app->context->session->get('benefits') ?></u>
        </p>
    <?php endif ?>
    <?php if (Reagordi::$app->context->session->get('doc_benefits')): ?>
        <p><b>Документы, представляющий право на льготы</b>:
            <u><?= Reagordi::$app->context->session->get('doc_benefits') ?></u></p>
    <?php endif ?>
    <?php if (Reagordi::$app->context->session->get('social_status')): ?>
        <p><b>Социальный статус</b>: <u><?= Reagordi::$app->context->session->get('social_status') ?></u></p>
    <?php endif ?>
    <table width="100%" cellpadding="0" cellspacing="0" border="1">
        <tr>
            <th>Законный представитель</th>
            <th>ФИО</th>
            <th>Телефон</th>
            <th>Место работы</th>
        </tr>
        <tr>
            <td><?= $status[Reagordi::$app->context->session->get('parents_one_status')] ?></td>
            <td><?= Reagordi::$app->context->session->get('parents_one_last_name') ?> <?= Reagordi::$app->context->session->get('parents_one_first_name') ?> <?= Reagordi::$app->context->session->get('parents_one_middle_name') ?></td>
            <td><?= Reagordi::$app->context->session->get('parents_one_phone') ?></td>
            <td><?= Reagordi::$app->context->session->get('parents_one_work') ?></td>
        </tr>
        <?php if (Reagordi::$app->context->session->get('parents_two_last_name') && Reagordi::$app->context->session->get('parents_two_first_name')): ?>
            <tr>
                <td><?= $status[Reagordi::$app->context->session->get('parents_two_status')] ?></td>
                <td><?= Reagordi::$app->context->session->get('parents_two_last_name') ?> <?= Reagordi::$app->context->session->get('parents_two_first_name') ?> <?= Reagordi::$app->context->session->get('parents_two_middle_name') ?></td>
                <td><?= Reagordi::$app->context->session->get('parents_two_phone') ?></td>
                <td><?= Reagordi::$app->context->session->get('parents_two_work') ?></td>
            </tr>
        <?php endif ?>
    </table>
    <br/>
    <br/>
    <div style="position: absolute;bottom:-20px;right:0">
        <div style="float: left">Дата «_____» ____________________ 20_____ г.</div>
        <div style="float: right;">____________________</div>
        <div style="clear: both"></div>
        <div align="right" style="font-size: 8px">(подпись поступающего)</div>
    </div>


    <div style="page-break-before: always;"></div>

    <p>
    <div style="float: left">Среднее профессиональное образование
        получаю<?php if (!Reagordi::$app->context->session->has('checkbox_obraz_one')): ?> не<?php endif ?> впервые
    </div>
    <div style="float: right;">____________________</div>
    <div style="clear: both"></div>
    <div align="right" style="font-size: 8px">(подпись поступающего)</div>
    </p><br/><br/><br/>
    <p>
    <div style="float: left">С уставом, лицензией на право осуществления образовательной деятельности и свидетельством о
        государственной аккредитации, правилами приема, правилами внутреннего трудового распорядка ознакомлен
    </div>
    <div style="clear: both"></div>
    <div style="float: right;">____________________</div>
    <div style="clear: both"></div>
    <div align="right" style="font-size: 8px;vertical-align: bottom">(подпись поступающего)</div>
    </p><br/><br/><br/>
    <p>
    <div style="float: left">В случае не поступления на обучение выдача оригиналов документов производится при наличии
        расписки в приеме документов, выданной сотрудником приемной комиссии
    </div>
    <div style="clear: both"></div>
    <div style="float: right;">____________________</div>
    <div style="clear: both"></div>
    <div align="right" style="font-size: 8px">(подпись поступающего)</div>
    </p><br/><br/><br/>
    <p>
    <div style="float: left">Обязуюсь предоставить подлинник документа об образовании не
        позднее <?= date('d.m.Y', Reagordi::$app->config->get('education', 'priem', 'end_date')) ?></div>
    <div style="clear: both"></div>
    <div style="float: right;">____________________</div>
    <div style="clear: both"></div>
    <div align="right" style="font-size: 8px">(подпись поступающего)</div>
    </p><br/><br/><br/>
    <p>
    <div style="float: left">Подлинность документа об образовании подтверждаю</div>
    <div style="float: right;">____________________</div>
    <div style="clear: both"></div>
    <div align="right" style="font-size: 8px">(подпись поступающего)</div>
    </p>
    <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
    <p>
    <div align="right">Подпись ответственного лица приемной комиссии ____________ / _____________</div>
    <div align="right" style="font-size: 8px">(подпись)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(расшифровка)</div>
    </p>
    <p align="right">Дата «_____» ____________________ 20_____ г.</p>
    <br/><br/><br/><br/><br/><br/>
    <p>Документы получены:
        ____________________________________________________________________________________________</p>
    <p>
        ____________________________________________________________________________________________________________________</p>
    <p>
        ____________________________________________________________________________________________________________________</p>
    <p>
        ____________________________________________________________________________________________________________________</p>
    <br/><br/>
    <p>
    <div style="float: left">Дата «_____» ____________________ 20_____ г.</div>
    <div style="float: right;">____________________</div>
    <div style="clear: both"></div>
    <div align="right" style="font-size: 8px">(подпись поступающего)</div>
    </p>


    <div style="page-break-before: always;"></div>


    <?php
    if ($age) {
        $c = is_file(APP_DIR . '/php_interface/priem/age.tpl') ? file_get_contents(APP_DIR . '/php_interface/priem/age.tpl') : '';
    } else {
        $c = is_file(APP_DIR . '/php_interface/priem/no_age.tpl') ? file_get_contents(APP_DIR . '/php_interface/priem/no_age.tpl') : '';
    }
    if (!$age) $c = str_replace('{fio}', $nc->q($session->get('last_name') . ' ' . $session->get('first_name') . ' ' . $session->get('middle_name'), \NCL::$RODITLN), $c);
    else $c = str_replace('{fio}', $session->get('last_name') . ' ' . $session->get('first_name') . ' ' . $session->get('middle_name'), $c);
    $c = str_replace('{parent_fio}', $session->get('parents_one_last_name') . ' ' . $session->get('parents_one_first_name') . ' ' . $session->get('parents_one_middle_name'), $c);
    $c = str_replace('{addres}', $addres, $c);
    $c = str_replace('{parent_addres}', $addres, $c);
    $c = str_replace('{pass_serial}', $session->get('series_passport'), $c);
    $c = str_replace('{pass_number}', $session->get('number_passport'), $c);
    $c = str_replace('{pass}', $session->get('passport_whom') . ' ' . date('d.m.Y', $passport_date->getTimestamp()), $c);
    $c = str_replace('{type_doc}', $type_doc[Reagordi::$app->context->session->get('type_doc')], $c);
    $c = str_replace('{parent_type_doc}', $type_doc[Reagordi::$app->context->session->get('type_doc')], $c);
    $c = str_replace('{parent_pass_serial}', $session->get('parents_one_series_passport'), $c);
    $c = str_replace('{parent_pass_number}', $session->get('parents_one_number_passport'), $c);
    $_date = new DateTime($session->get('parents_one_passport_date'));
    $_date = $_date->getTimestamp();
    $c = str_replace('{parent_pass}', $session->get('parents_one_passport_whom') . ' ' . date('d.m.Y', $_date), $c);
    echo $c;
    ?>

    <?php if (Reagordi::$app->context->session->has('checkbox_obsaga')): ?>
        <div style="page-break-before: always;"></div>
        <div style="float: right;width: 50%">Директору ГАПОУ КО «КТК» А.В.Никитину<br/>
            от
            <u><?= $nc->q($session->get('last_name') . ' ' . $session->get('first_name') . ' ' . $session->get('middle_name'), \NCL::$RODITLN) ?></u><br/>
            Адрес по прописке <u><?= $addres ?></u><br/>
            <u><?= $session->get('phone') ?></u>
        </div>
        <div style="clear: both"></div><br/>
        <br/>
        <br/>
        <p align="center"><b>ЗАЯВЛЕНИЕ</b></p>
        <p>
        <div>Прошу предоставить мне
            <u><?= $nc->q($session->get('last_name') . ' ' . $session->get('first_name') . ' ' . $session->get('middle_name'), \NCL::$DATELN) ?></u>
            место в общежитии
            на <?= date('Y') ?> - <?= date('Y') + 1 ?> учебный год в связи с тем, что
            __________________________________________________________________________________________________________
        </div>
        <div align="right" style="font-size: 8px">(при наличии указать льготную категорию: инвалид, ребенок инвалид,
            дети сироты, дети, оставшиеся без попечения родителей, проживающий на территории ЧАЭС и др.)
        </div>
        </p>
        <p>Законный представитель
            <u><?= $session->get('parents_one_last_name') . ' ' . $session->get('parents_one_first_name') . ' ' . $session->get('parents_one_middle_name') ?></u>
            (<?= $session->get('parents_two_phone') ?>)
        </p>
        <p>
            В случае отказа от предоставленного места в общежитии обязуюсь в течение
            3-х рабочих дней уведомить коменданта общежития.
        </p>

        <br/>
        <br/>
        <br/>
        <div align="right">____ "__________" 20___ г. ____________ / _____________________</div>
        <div align="right" style="font-size: 8px">(подпись)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(расшифровка
            подписи)
        </div>
    <?php endif ?>
    </body>
    </html>
    <?php
    // instantiate and use the dompdf class
    $dompdf = new Dompdf();
    $dompdf->loadHtml(ob_get_clean());

    $options = $dompdf->getOptions();

    $options->set('enable_remote', true);
    //$options->set('defaultFont', 'dejavu sans');

    $dompdf->setOptions($options);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream('statement.pdf', ['Attachment' => 0]);
}


Reagordi::$app->context->i18n->loadModuleLangFile(__DIR__ . '/pages/priem/statement.php');

Loader::registerNamespace('Reagordi\\Education', __DIR__ . '/src');

require __DIR__ . '/lib/ncl/NCLNameCaseRu.php';

