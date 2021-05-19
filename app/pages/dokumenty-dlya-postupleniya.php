<?php

/** @var $collector Phroute\Phroute\RouteCollector */

$collector->any('dokumenty-dlya-postupleniya.html', function () {
    Reagordi::$app->context->setTitle('Документы для поступления');
    Reagordi::$app->context->setDescription('Документы для поступления');

    ob_start();
    ?>
<style>
.wp-block-file {
    margin-top: 10px;
}
</style>
    <div class="card-box table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <td class="has-text-align-left" data-align="left"><strong>Описание</strong></td>
                <td class="has-text-align-left" data-align="left"><strong>Бланк</strong></td>
                <td class="has-text-align-left" data-align="left"><strong>Образец</strong></td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="has-text-align-left" data-align="left">1) Бланк заявления</td>
                <td class="has-text-align-left" data-align="left">
                    <div class="wp-block-file"><a class="wp-block-file__button" href="<?= HOME_URL ?>/uploads/zayavlenie-o-prieme-spo.docx" download="">Скачать</a></div>
                </td>
                <td class="has-text-align-left" data-align="left">
                    <div class="wp-block-file"><a class="wp-block-file__button" href="<?= HOME_URL ?>/uploads/obrazecz-zayavleniya-o-priyome.pdf" download="">Скачать</a></div>
                </td>
            </tr>
            <tr>
                <td class="has-text-align-left" data-align="left">2) Согласие на обработку персональных данных:</td>
                <td class="has-text-align-left" data-align="left"></td>
                <td class="has-text-align-left" data-align="left"></td>
            </tr>
            <tr>
                <td class="has-text-align-left" data-align="left">Для несовершеннолетних</td>
                <td class="has-text-align-left" data-align="left">
                    <div class="wp-block-file"><a class="wp-block-file__button" href="<?= HOME_URL ?>/uploads/soglasie-na-obrabotku-personalnyh-dannyh-podopechnogo.docx" download="">Скачать</a></div>
                 </td>
                <td class="has-text-align-left" data-align="left">
                    <div class="wp-block-file"><a class="wp-block-file__button" href="<?= HOME_URL ?>/uploads/obrazczy-zapolneniya-soglasij.pdf" download="">Скачать</a></div>
                </td>
            </tr>
            <tr>
                <td class="has-text-align-left" data-align="left">Для совершеннолетних</td>
                <td class="has-text-align-left" data-align="left"><div class="wp-block-file"><a class="wp-block-file__button" href="<?= HOME_URL ?>/uploads/soglasie-na-obrabotku-personalnyh-dannyh-sovershennoletnego.docx" download="">Скачать</a></div>
                </td>
                <td class="has-text-align-left" data-align="left">
                    <div class="wp-block-file"><a class="wp-block-file__button" href="<?= HOME_URL ?>/uploads/obrazczy-zapolneniya-soglasij-1.pdf" download="">Скачать</a></div>
                </td>
            </tr>
            <tr>
                <td class="has-text-align-left" data-align="left">3) Ксерокопия документа, удостоверяющего личность и гражданство (паспорт) стр. 2-3, 5.</td>
                <td class="has-text-align-left" data-align="left">&nbsp;</td>
                <td class="has-text-align-left" data-align="left">&nbsp;</td>
            </tr>
            <tr>
                <td class="has-text-align-left" data-align="left">4) Оригинал или ксерокопия документа об образовании (аттестат об окончании 9-го или 11-го класса)</td>
                <td class="has-text-align-left" data-align="left">&nbsp;</td>
                <td class="has-text-align-left" data-align="left">&nbsp;</td>
            </tr>
            <tr>
                <td class="has-text-align-left" data-align="left">5) 4 фотографии размером 3*4</td>
                <td class="has-text-align-left" data-align="left">&nbsp;</td>
                <td class="has-text-align-left" data-align="left">&nbsp;</td>
            </tr>
            </tbody>
        </table>
        <hr />
        <p><strong>Документы можно подать следующими способами:</strong></p>
        <ol>
            <li>Самый предпочтительный способ. В электронной форме (документ на бумажном носителе, преобразованный в электронную форму путём сканирования или фотографирования с обеспечением машиночитаемого распознавания его реквизитов): посредством электронной почты организации (<a href="mailto:priem.ktk@yandex.ru">priem.ktk@yandex.ru</a>)</li>
            <li>Через операторов почтовой связи общего доступа &nbsp;по адресу: 248009, Калужская область, г. Калуга, ул. Грабцевское шоссе, д. 126</li>
            <li>С использованием функционала (сервисов) региональных порталов государственных и муниципальных услуг (ГОСУСЛУГИ)&nbsp;<a href="https://entry.admoblkaluga.ru/" target="_blank" rel="noreferrer noopener">https://entry.admoblkaluga.ru/</a></li>
            <li>По предварительной записи по телефону (4842) 52-18-34</li>
        </ol>
    </div>

    <div class="tabs-vertical-env">
        <ul class="nav tabs-vertical">
            <li class="active">
                <a href="#vmy-tab-1" data-toggle="tab">Для инвалидов и лиц с ОВЗ</a>
            </li>
            <li>
                <a href="#vmy-tab-2" data-toggle="tab">Для иностранных граждан </a>
            </li>
            <li>
                <a href="#vmy-tab-3" data-toggle="tab">Для лиц без гражданства</a>
            </li>
            <li>
                <a href="#vmy-tab-4" data-toggle="tab">Для соотечественников, проживающих за рубежом</a>
            </li>
            <li>
                <a href="#vmy-tab-5" data-toggle="tab">Для сирот или оставшихся без попечения родителей</a>
            </li>
        </ul>
        <div class="tab-content" style="width:100%">
            <div class="tab-pane active" id="vmy-tab-1">
                Для абитуриентов-инвалидов и лиц с ОВЗ к <a href="/pravila-priyoma">основному пакету документов</a> необходимо предоставить следующие:
                <ol>
                    <li>Справка МСЭ (копия).</li>
                    <li>Индивидуальная программа реабилитации инвалида (копия).</li>
                    <li><a href="<?= HOME_URL ?>/uploads/dlya-invalidov-zayavl.-o-soglasii-na-obuch.-po-osnov.-prog.docx" style="margin: 10px 0;" target="_blank" rel="noopener noreferrer">Согласие на обучение по основным профессиональным образовательным программам</a></li>
                    <li>Для лиц с ОВЗ заключение ПМПК (копия).</li>
                </ol>
            </div>
            <div class="tab-pane" id="vmy-tab-2">
                <p align="left">Копию&nbsp; документа, удостоверяющего личность поступающего,либо документ, удостоверяющий личность иностранного гражданина в Российской Федерации;</p>
                <p align="left"><strong>2.</strong>&nbsp;Оригинал документа государственного образца об образовании (или его заверенную копию в установленном порядке) либо оригинал документа иностранного государства об уровне образования и (или) квалификации, признаваемый в Российской Федерации на уровне документа государственного образца об образовании (или его заверенную в установленном порядке копию), а также в случае, предусмотренном законодательством Российской Федерации, копию свидетельства о признании данного документа;</p>
                <p align="left"><strong>3.</strong>&nbsp;Заверенный в установленном порядке перевод на русский язык документа иностранного государства об уровне образования и (или) квалификации и приложения к нему (если последнее предусмотрено законодательством государства, в котором выдан документ об образовании);</p>
                <p align="left"><strong>4.</strong>&nbsp;Копию визы на въезд в Российскую Федерацию, если иностранный гражданин прибыл в Российскую Федерацию по въездной визе;</p>
                <p align="left"><strong>5.</strong>&nbsp;4 фотографии 3х4;</p>
                <p align="left"><strong>Все переводы на русский язык должны быть выполнены на имя и фамилию, указанные в документе, удостоверяющем личность иностранного гражданина в Российской Федерации.&nbsp;</strong></p>
            </div>
            <div class="tab-pane" id="vmy-tab-3">
                <p align="left"><strong>1.</strong>&nbsp;Копию разрешения на временное проживание или вид на жительство или&nbsp; копию документа, выданного иностранным государством и признаваемый в соответствии с международным договором РФ в качестве документа, удостоверяющего личность лица без гражданства;</p>
                <p align="left"><strong>2.</strong>&nbsp;Оригинал документа государственного образца об образовании (или его заверенную копию в установленном порядке) либо оригинал документа иностранного государства об уровне образования и (или) квалификации, признаваемый в Российской Федерации на уровне документа государственного образца об образовании (или его заверенную в установленном порядке копию), а также в случае, предусмотренном законодательством Российской Федерации, копию свидетельства о признании данного документа;</p>
                <p align="left"><strong>3.</strong>&nbsp;Копию визы на въезд в Российскую Федерацию, если иностранный гражданин прибыл в Российскую Федерацию по въездной визе;</p>
                <p align="left"><strong>4.</strong>&nbsp;4 фотографии 3х4;</p>
                <p align="left"><strong>Все переводы на русский язык должны быть выполнены на имя и фамилию, указанные в документе, удостоверяющем личность иностранного гражданина в Российской Федерации.</strong></p>
            </div>
            <div class="tab-pane" id="vmy-tab-4">
                <p align="left"><strong>1.</strong>&nbsp;Копию документов, подтверждающих принадлежность к статусу соотечественника, проживающего за рубежом (гражданство СССР, гражданскую принадлежность или отсутствие таковой на момент предъявления - для лиц, состоявших в гражданстве СССР;&nbsp; проживание в прошлом на территории Российского государства, Российской республики, РСФСР, СССР или Российской Федерации, соответствующую гражданскую принадлежность при выезде с этой территории и гражданскую принадлежность или отсутствие таковой на момент предъявления - для выходцев (эмигрантов); родство по прямой восходящей линии с указанными лицами - для потомков соотечественников; проживание за рубежом - для всех указанных лиц);</p>
                <p align="left"><strong>2.</strong>&nbsp;Копию визы на въезд в Российскую Федерацию, если иностранный гражданин прибыл в Российскую Федерацию по въездной визе;</p>
                <p align="left"><strong>3.</strong>&nbsp;Оригинал документа государственного образца об образовании (или его заверенную копию в установленном порядке) либо оригинал документа иностранного государства об уровне образования и (или) квалификации, признаваемый в Российской Федерации на уровне документа государственного образца об образовании (или его заверенную в установленном порядке копию), а также в случае, предусмотренном законодательством Российской Федерации, копию свидетельства о признании данного документа;</p>
                <p align="left"><strong>4.</strong>&nbsp;4 фотографии 3х4;</p>
                <p align="left"><strong>Все переводы на русский язык должны быть выполнены на имя и фамилию, указанные в документе, удостоверяющем личность иностранного гражданина в Российской Федерации.</strong></p>
            </div>
            <div class="tab-pane" id="vmy-tab-5">
                <h3 align="center">Документы, которые необходимо предоставить для подтверждения статуса сироты или оставшегося без попечения родителей, при поступлении и постановке на государственное обеспечение детям до 18 лет под опекой</h3>
                <p style="text-align: left;" align="center"><strong>1.&nbsp;</strong>Паспорт (сделать 2 ксерокопии!)</p>
                <p style="text-align: left;" align="center"><strong>2.&nbsp;</strong>Документы о состоянии здоровья (справка формы №286, медицинская карта).</p>
                <p style="text-align: left;" align="center"><strong>3.&nbsp;</strong>Характеристика на ребенка.</p>
                <p style="text-align: left;" align="center"><strong>4.&nbsp;</strong>Фотографии 4 шт. форматом 3 на 4.</p>
                <p style="text-align: left;" align="center"><strong>5.&nbsp;</strong>Копия свидетельства о рождении.</p>
                <p style="text-align: left;" align="center"><strong>6.&nbsp;</strong>Копия медицинского полиса.</p>
                <p style="text-align: left;" align="center"><strong>7.&nbsp;</strong>Копия страхового свидетельства (если есть).</p>
                <p style="text-align: left;" align="center"><strong>8.&nbsp;</strong>Документы о родителях подтверждающие их отсутствие или то, что родители не занимаются воспитанием ребенка:</p>
                <p style="text-align: left;">&nbsp;&nbsp; * ксерокопия свидетельства о смерти родителей&nbsp;<strong>(заверенная)</strong>;</p>
                * решение суда о лишении родительских прав&nbsp;<strong>(подлинник или его ксерокопия заверенная)</strong>;

                * решение суда об установлении опеки или постановление администрации района об установлении опеки&nbsp;<strong>(подлинник или его ксерокопия заверенная)</strong>;

                * справка по форме № 25<strong>(оригинал).</strong>

                <strong>9.&nbsp;</strong>Документы об имеющемся жилье, месте прописки:

                * ксерокопии&nbsp;<strong>(заверенные)</strong>&nbsp;первой страницы&nbsp; паспорта и страницы с указанием места прописки;

                * справка из ЖРЭУ о составе семьи и наличии задолженности&nbsp; по квартплате&nbsp;<strong>(оригинал);</strong>
                <p align="left">&nbsp;&nbsp; * документы, подтверждающие право на имущество&nbsp;<strong>(свидетельство о праве собственности);</strong></p>
                <p align="left"><strong>10.&nbsp;</strong><strong>При поступлении из дома - интерната или детского дома семейного типа:</strong></p>
                <strong>Личное дело ребенка со всеми документами-оригиналами!</strong><strong>&nbsp;<em>(</em></strong><strong><em>список документов которые должны находиться в деле прилагается с указанием копии или оригинала</em></strong><strong><em>)</em></strong>
                <p align="left"><strong><em>Все ксерокопии должны быть заверены!</em></strong></p>


                <hr>

                <h3 style="text-align: center;" align="left">Документы, которые необходимо предоставить для подтверждения статуса сироты или оставшегося без попечения родителей, при поступлении и постановке на государственное обеспечение после 18 лет</h3>
                <p align="left"><strong>1.&nbsp;</strong>Паспорт (сделать 2 ксерокопии!)</p>
                <p align="left"><strong>2.&nbsp;</strong>Документы о состоянии здоровья (справка формы №286, медицинская карта).</p>
                <p align="left"><strong>3.&nbsp;</strong>Характеристика на ребенка.</p>
                <p align="left"><strong>4.&nbsp;</strong>Фотографии 4 шт. форматом 3 на 4.</p>
                <p align="left"><strong>5.&nbsp;</strong>Копия свидетельства о рождении.</p>
                <p align="left"><strong>6.&nbsp;</strong>Копия медицинского полиса.</p>
                <p align="left"><strong>7.&nbsp;</strong>Копия страхового свидетельства (если есть).</p>
                <p align="left"><strong>8.&nbsp;</strong>Документы о родителях подтверждающие их отсутствие или то, что родители не занимаются воспитанием ребенка: * ксерокопия свидетельства о смерти родителей&nbsp;<strong>(заверенная)</strong>; * решение суда о лишении родительских прав&nbsp;<strong>(подлинник или его ксерокопия заверенная)</strong>; * решение суда об установлении опеки или постановление администрации района об установлении опеки&nbsp;<strong>(подлинник или его ксерокопия заверенная)</strong>; * справка по форме № 25<strong>(оригинал).</strong>&nbsp;<strong>9.&nbsp;</strong><strong>Документ из Городской управы (или из Управления образования)<em>&nbsp;о том, что по месту обучения студенту должны выплачивать денежные средства в течение всего периода обучения и выходное пособие при выпуске, выданное согласно Федерального Закона от 21.12.1996 г. № 159-ФЗ «О дополнительных гарантиях по социальной защите детей – сирот, детей, оставшихся без попечения родителей», во исполнение Закона калужской области от 2 8.04.2005г. № 61-ОЗ (в ред. Закона Калужской области от 27.06.2005г. №98-ОЗ</em></strong>&nbsp;<em>(в ред. Законов Калужской области от 27.06.2005&nbsp;</em><em>N 98-ОЗ</em><em>, от 02.02.2007&nbsp;</em><em>N 287-ОЗ</em><em>, от 02.12.2008&nbsp;</em><em>N 498-ОЗ</em><em>, от 09.03.2010&nbsp;</em><em>N 640-ОЗ</em><em>, от 06.07.2011&nbsp;</em><em>N 161-ОЗ</em><em>)<strong>&nbsp;«О размере и порядке назначения выплаты опекунам&nbsp; (попечителям денежных средств на содержание детей»&nbsp;</strong></em>(оригинал).&nbsp;<strong>10.&nbsp;</strong>Документы об имеющемся жилье, месте прописки: * ксерокопии&nbsp;<strong>(заверенные)</strong>&nbsp;первой страницы&nbsp; паспорта и страницы с указанием места прописки; * справка из ЖРЭУ о составе семьи и наличии задолженности&nbsp; по квартплате&nbsp;<strong>(оригинал);</strong>&nbsp;* документы, подтверждающие право на имущество&nbsp;<strong>(свидетельство о праве собственности).</strong></p>
                <p align="left"><strong><em>Все ксерокопии должны быть заверены!</em></strong></p>


                <hr>

                <h3 style="text-align: center;" align="left">Дети из детских домов принимаются только при наличии личного дела!</h3>
                <p align="left"><strong><em>(Список документов&nbsp; в личном деле прилагается с указанием копии или оригинала.&nbsp;</em></strong><strong><em>Все ксерокопии должны быть заверены!</em></strong><strong><em>)&nbsp;</em></strong></p>
                <p align="left"><strong><em>Детям из детских домов города Калуги общежитие не предоставляется!!!</em></strong></p>
                <p align="left"><strong>В личном деле воспитанника должны находиться следующие документы:</strong></p>
                <p align="left"><strong>1.&nbsp;</strong>Фотографии 4 шт. форматом 3 на 4.</p>
                <p align="left"><strong>2.&nbsp;</strong>Характеристика на ребенка.</p>
                <p align="left"><strong>3.&nbsp;</strong>Свидетельство о рождении ребенка (оригинал).</p>
                <p align="left"><strong>4.&nbsp;</strong>Документы об образовании (оригинал).</p>
                <p align="left"><strong>5.&nbsp;</strong>Копия медицинского полиса (заверенная).</p>
                <p align="left"><strong>6.&nbsp;</strong>Документы о состоянии здоровья (справка формы №286, медицинская карта).</p>
                <p align="left"><strong>7.&nbsp;</strong>Копия страхового свидетельства (если есть).</p>
                <p align="left"><strong>8.</strong>&nbsp;Извещение об установлении, изменении, уточнении и (или) снятии диагноза(заполняется медицинским работником) (<strong>оригинал</strong>).</p>
                <p align="left"><strong>9.&nbsp;</strong>Сведения о родителях:</p>
                <p align="left">&nbsp;&nbsp; - свидетельство о браке (<strong>заверенная копия)</strong>; -&nbsp; свидетельство о разводе (<strong>заверенная копия);</strong>&nbsp;- решение суда о лишении свободы (<strong>заверенная копия);</strong>&nbsp;- справка ВТЭК и ВКК о том, что родители находятся на длительном лечении<strong>(оригинал или заверенная копия)</strong>; - заключение медико-психолого-педагогической комиссии&nbsp;<strong>(оригинал или заверенная копия).</strong>&nbsp;<strong>10.&nbsp;</strong>Документы о родителях подтверждающие их отсутствие или то, что родители не занимаются воспитанием ребенка: - ксерокопия свидетельства о смерти родителей&nbsp;<strong>(заверенная)</strong>; - решение суда о лишении родительских прав&nbsp;<strong>(подлинник или его ксерокопия заверенная)</strong>; - решение суда об установлении опеки или постановление администрации района об установлении опеки&nbsp;<strong>(подлинник или его ксерокопия заверенная)</strong>; - справка по форме № 25<strong>(оригинал).</strong>&nbsp;<strong>11.&nbsp;</strong>Документы по жилью:</p>

                <ul>
                    <li>ксерокопии&nbsp;&nbsp;<strong>(заверенные)</strong>&nbsp;первой страницы&nbsp; паспорта и страницы с указанием места прописки&nbsp;<strong>(сделать 2 ксерокопии!)</strong></li>
                    <li>справка из ЖРЭУ о составе семьи и наличии задолженности&nbsp; по квартплате&nbsp;<strong>(оригинал);</strong></li>
                    <li>выписка из домовой книги&nbsp;<strong>(оригинал);</strong></li>
                    <li>документы, подтверждающие право на имущество&nbsp;<strong>(свидетельство о праве собственности);</strong></li>
                    <li>копия из финансового лицевого счета;</li>
                    <li>копия свидетельства о государственной регистрации;</li>
                    <li>договор соцнайма&nbsp;<strong>(оригинал);</strong></li>
                    <li>вся переписка о постановке на государственную субсидию&nbsp;<strong>(оригинал).</strong></li>
                </ul>
                <p align="left"><strong>12.&nbsp;</strong><strong><em>Анкета на ребенка, сведения о котором учитываются в государственном банке данных о детях-сиротах и детях, оставшихся без попечения родителей (копия).</em></strong></p>
                <p align="left"><strong>13.&nbsp;</strong>Постановление или распоряжение Администрации местного самоуправления о помещении детей в организацию для детей-сирот и детей, оставшихся без попечения родителей.<strong>&nbsp;(оригинал).</strong></p>
                <p align="left"><strong>14.&nbsp;</strong>Путевка о направлении министерства по делам семьи, демографической и социальной политики Калужской области.<strong>&nbsp;(оригинал).</strong></p>
                <p align="left"><strong>15.&nbsp;</strong>Акт обследования условий жизни ребенка в семье.<strong>&nbsp;(оригинал).</strong></p>
                <p align="left">&nbsp;<strong>16.&nbsp;</strong>Заключение о целесообразности помещения несовершеннолетнего в организацию для детей-сирот и детей, оставшихся без попечения родителей.<strong>&nbsp;(оригинал).</strong></p>
                <p align="left"><strong>17.&nbsp;</strong>Документы, подтверждающие право наследования.</p>
                <p align="left"><strong>18.&nbsp;</strong>Сберегательные книжки.</p>
                <p align="left"><strong>19.&nbsp;</strong>Справка из собеса о получении пособия.</p>
                <p align="left"><strong>20.&nbsp;</strong>Пенсионная книжка.</p>
                <p align="left"><strong>21.&nbsp;</strong>Справка о братьях и сестрах.</p>
                <p align="left"><strong>22.&nbsp;</strong>Справка о нахождении на полном государственном обеспечении по месту проживания&nbsp;(из дома - интерната или детского дома семейного типа).</p>
            </div>
        </div>
    </div>
    <?php
    Reagordi::$app->context->view->assign('sitebar', true);
    Reagordi::$app->context->view->assign('conteiner', ob_get_clean());

    return Reagordi::$app->context->view->fech();
});