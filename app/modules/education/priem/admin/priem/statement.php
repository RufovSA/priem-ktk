<?php
/**
 * Reagordi CMS Generator
 *
 * @package reagordi/cms
 * @subpackage generate-page
 * @copyright Reagordi (c) 2020
 * @create-date 01.02.2021 10:53:12
 */

use Reagordi\Framework\Web\Asset;
use Reagordi\Education\Models\Entrant;

/** @var $collector Phroute\Phroute\RouteCollector */

$collector->any(
    'priem/statement.html',
    function () {
        Reagordi::getInstance()->getApplication()->dbInit();

        if (Reagordi::$app->context->request->cookie->get('verify_offline') != Reagordi::$app->config->get('education', 'priem', 'key')) {
            header('Location: /');
            exit();
        }

        Reagordi::$app->context->setTitle(t('Application submission'));
        Reagordi::$app->context->setDescription(t('Application submission'));

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

        Asset::getInstance()->addCss(
            TEMPLATE_URL . '/plugins/datatables/jquery.dataTables.min.css',
            100
        );
        Asset::getInstance()->addCss(
            TEMPLATE_URL . '/plugins/datatables/buttons.bootstrap.min.css',
            100
        );
        Asset::getInstance()->addCss(
            TEMPLATE_URL . '/plugins/datatables/fixedHeader.bootstrap.min.css',
            100
        );
        Asset::getInstance()->addCss(
            TEMPLATE_URL . '/plugins/datatables/responsive.bootstrap.min.css',
            100
        );
        Asset::getInstance()->addCss(
            TEMPLATE_URL . '/plugins/datatables/dataTables.colVis.css',
            100
        );
        Asset::getInstance()->addCss(
            TEMPLATE_URL . '/plugins/datatables/fixedColumns.dataTables.min.css',
            100
        );
        Asset::getInstance()->addCss(
            TEMPLATE_URL . '/plugins/datatables/dataTables.bootstrap.min.css',
            100
        );

        Asset::getInstance()->addJs(
            TEMPLATE_URL . '/plugins/datatables/jquery.dataTables.min.js',
            100
        );
        Asset::getInstance()->addJs(
            TEMPLATE_URL . '/plugins/datatables/dataTables.bootstrap.js',
            100
        );
        Asset::getInstance()->addJs(
            TEMPLATE_URL . '/plugins/datatables/dataTables.buttons.min.js',
            100
        );

        ob_start();
        $where = '';
        $params = [];
        $request = Reagordi::$app->context->request;

        $entrant_status = null;
        if (!is_null($request->get('entrant_status')) && $request->get('entrant_status') >= 0 && $request->get('entrant_status') < 5) {
            $where .= '`entrant_status` = ?';
            //$entrant_status = '2';
            $entrant_status = $request->get('entrant_status');
            $params[] = $entrant_status;
        }

        if ($request->get('type_doc_edu')) {
            $where .= ' AND `type_doc_edu` = ?';
            $params[] = $request->get('type_doc_edu');
        }

        if ($request->get('specialtie1')) {
            $where .= ' AND `specialtie1` = ?';
            $params[] = $request->get('specialtie1');
        }

        if ($request->get('checkbox_obsaga')) {
            $where .= ' AND `checkbox_obsaga` = ?';
            $params[] = '1';
        }

        if ($request->get('type_certificate')) {
            $where .= ' AND `type_certificate` = ?';
            $params[] = $request->get('type_certificate');
        }

        $where .= ' ORDER BY `average_score` DESC';

        $statement = Entrant::getList($where, $params);

        $benefits_status = array(
            1 => 'Инвалид',
            'Сирота',
            'Малоимущие',
            'ЧС',
            'Многодетные',
        );

        $language_status = array(
            1 => 'Английский язык',
            'Немецкий язык',
            'Французский язык',
            'Другое',
        );
        ?>
        <style>
            @media print {
                #rg_panel, #datatable_wrapper #datatable_length, #datatable_wrapper #datatable_filter,
                table.dataTable thead th.sorting_asc:after,
                table.dataTable thead th.sorting:after,
                table.dataTable thead th.sorting_desc:after,
                #datatable_info, #datatable_paginate {
                    display: none;
                }

                table, table tr, table th, table td {
                    background-color: #fff;
                    border-color: #000;
                }

                a[href]:after {
                    content: "";
                }
            }
        </style>
        <div id="rg_panel" class="row">
            <div class="col-sm-12">
                <div class="btn-group pull-right m-t-15">
                    <button type="button" class="btn btn-default waves-effect" data-toggle="modal"
                            data-target="#rg_filter_statement">Фильтр
                    </button>
                    <button type="button" class="btn btn-default waves-effect" onclick="window.print();"
                            style="margin-left:10px">Печать
                    </button>
                </div>
                <h4 class="page-title">Заявления абитуриентов</h4>
                <ol class="breadcrumb">
                    <li>
                        <a href="<?= HOME_URL ?>/<?= Reagordi::$app->options->get('url', 'admin_path') ?>">Главная</a>
                    </li>
                    <li class="active">Заявления</li>
                </ol>
            </div>
        </div>

        <?php if (Reagordi::$app->context->server->getRequestMethod() == 'POST'): ?>
            <div id="rg_filter_info">
                Фильтр по:<br/>
                <?php if ($request->get('type_doc_edu') == '1'): ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>После</b>: 9 класса
                    <br/><?php endif ?>
                <?php if ($request->get('type_doc_edu') == '2'): ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>После</b>: 11 класса
                    <br/><?php endif ?>
                <?php if ($request->get('type_certificate') == '0'): ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <b>Поданные документы являются копией</b><br/><?php endif ?>
                <?php if ($request->get('type_certificate') == '1'): ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <b>Поданные документы являются оригиналом</b><br/><?php endif ?>
                <?php if ($request->get('specialtie1')): ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Специальности</b>: <?= $request->get('specialtie1') ?>
                    <br/><?php endif ?>
                <?php if ($request->get('benefits')): ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <b>Льготы</b>: <?= $request->get('benefits') ?><br/><?php endif ?>
                <?php if ($request->get('checkbox_obsaga')): ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Нуждаются
                    в общажитии</b><br/><?php endif ?>
                <?php if ($request->get('average_score')): ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>По
                    средниму баллу</b><br/><?php endif ?>
            </div><br/>
        <?php endif ?>

        <div>Перейти на заявление абитуриента №</div>
            <div class="row">
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1"><?= date('Y') ?>_</span>
                        <input type="text" id="id_statement" class="form-control" placeholder="Идентификатор заявления" aria-describedby="basic-addon1" />
                    </div>
                </div>
                <div class="col-md-4">
                    <button class="btn btn-default" onclick="redirect_statement();">Перейти</button>
                </div>
            </div>

        <br />

        <div id="rg_filter_statement" class="modal fade in" aria-labelledby="full-width-modalLabel" tabindex="-1"
             aria-labelledby="myModalLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel">Настройка вывода</h4>
                    </div>
                    <form action="<?= HOME_URL ?>/<?= Reagordi::$app->options->get('url', 'admin_path') ?>/priem/statement.html"
                          method="post">
                        <div class="modal-body">
                            <div class="form-group col-sm-12">
                                <label class="control-label" for="type_certificate">Статус поданных документов</label>
                                <select id="type_certificate" name="type_certificate" class="ep_addres">
                                    <option value="">Не выбран</option>
                                    <option value="0"<?php if ($request->get('type_certificate') == '0'): ?> selected<?php endif ?>>
                                        Копия
                                    </option>
                                    <option value="1"<?php if ($request->get('type_certificate') == '1'): ?> selected<?php endif ?>>
                                        Оригинал
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-sm-12">
                                <label class="control-label" for="type_doc_edu">Аттестат после</label>
                                <select id="type_doc_edu" name="type_doc_edu" class="ep_addres">
                                    <option value="">Не выбран</option>
                                    <option value="1"<?php if ($request->get('type_doc_edu') == '1'): ?> selected<?php endif ?>>
                                        9 кл.
                                    </option>
                                    <option value="2"<?php if ($request->get('type_doc_edu') == '2'): ?> selected<?php endif ?>>
                                        11 кл.
                                    </option>
                                </select>
                            </div>
                            <div class="form-group col-sm-12">
                                <?php
                                $specialties = Reagordi::$app->config->get('education', 'priem', 'specialties');

                                ?>
                                <label class="control-label" for="specialtie1">Специальность</label>
                                <select id="specialtie1" name="specialtie1" class="ep_addres">
                                    <option value="">Специальность</option>
                                    <?php foreach ($specialties as $specialtie): ?>
                                        <optgroup label="<?= $specialtie['name'] ?>">
                                            <?php foreach ($specialtie['value'] as $value): ?>
                                                <option value="<?= $value['name'] ?>"<?php if ($request->get(
                                                        'specialtie1'
                                                    ) ==
                                                    $value['name']): ?> selected<?php endif ?>><?= $value['name'] ?>
                                                    <?php if ($value['class'] == '1'): ?> (9 кл.)<?php else: ?> (11 кл.)<?php endif ?></option>
                                            <?php endforeach ?>
                                        </optgroup>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-12">
                                <label class="control-label" for="specialtie1">Льготы</label>
                                <select id="benefits" name="benefits" class="ep_addres">
                                    <option value="">--Льготы--</option>
                                    <?php foreach ($benefits_status as $key => $value): ?>
                                        <option <?php if ($request->get('benefits') == $key): ?> selected<?php endif ?>
                                                value="<?= $key ?>>"><?= $value ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-12">
                                <label class="control-label" for="foreign_language">Иностранный язык</label>
                                <select id="foreign_language" name="foreign_language" class="ep_addres">
                                    <option value="">--Иностранный язык--</option>
                                    <?php foreach ($language_status as $key => $value): ?>
                                        <option <?php if ($request->get('foreign_language') == $key): ?> selected<?php endif ?>
                                                value="<?= $key ?>>"><?= $value ?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="form-group col-sm-12">
                                <label class="control-label" for="entrant_status">Статус заявления</label>
                                <select id="entrant_status" name="entrant_status" class="ep_addres">
                                    <option>Все</option>
                                    <option value="0"<?php if ($entrant_status == '0'): ?> selected<?php endif ?>>
                                        Пустая
                                    </option>
                                    <option value="1"<?php if ($entrant_status == '1'): ?> selected<?php endif ?>>
                                        Загрузка документов
                                    </option>
                                    <option value="2"<?php if ($entrant_status == '2'): ?> selected<?php endif ?>>
                                        На обработке
                                    </option>
                                    <option value="3"<?php if ($entrant_status == '3'): ?> selected<?php endif ?>>
                                        На изменении
                                    </option>
                                    <option value="4"<?php if ($entrant_status == '4'): ?> selected<?php endif ?>>
                                        Завершена
                                    </option>
                                </select>
                            </div>
                            <div class="checkbox checkbox-custom col-sm-12">
                                <input id="checkbox_obsaga" name="checkbox_obsaga"
                                       type="checkbox"<?php if ($request->get('checkbox_obsaga')): ?> checked<?php endif ?>>
                                <label for="checkbox_obsaga">Общажитие</label>
                            </div>
                            <h4>Выводимые поля:</h4>
                            <div class="checkbox checkbox-custom col-sm-6" style="margin-top:0;margin-bottom:0">
                                <input id="view_average_score" name="view_average_score"
                                       type="checkbox" <?php if ($request->get('view_average_score')): ?> checked<?php endif ?><?php if (Reagordi::$app->context->server->getRequestMethod() != 'POST'): ?> checked<?php endif ?>>
                                <label for="view_average_score">Средний балл</label>
                            </div>
                            <div class="checkbox checkbox-custom col-sm-6">
                                <input id="view_type_doc_edu" name="view_type_doc_edu"
                                       type="checkbox" <?php if ($request->get('view_type_doc_edu')): ?> checked<?php endif ?><?php if (Reagordi::$app->context->server->getRequestMethod() != 'POST'): ?> checked<?php endif ?>>
                                <label for="view_type_doc_edu">Аттестат</label>
                            </div>
                            <div class="checkbox checkbox-custom col-sm-6">
                                <input id="view_specialtie1" name="view_specialtie1"
                                       type="checkbox" <?php if ($request->get('view_specialtie1')): ?> checked<?php endif ?><?php if (Reagordi::$app->context->server->getRequestMethod() != 'POST'): ?> checked<?php endif ?>>
                                <label for="view_specialtie1">Специальность</label>
                            </div>
                            <div class="checkbox checkbox-custom col-sm-6">
                                <input id="view_checkbox_obsaga" name="view_checkbox_obsaga"
                                       type="checkbox" <?php if ($request->get('view_checkbox_obsaga')): ?> checked<?php endif ?><?php if (Reagordi::$app->context->server->getRequestMethod() != 'POST'): ?> checked<?php endif ?>>
                                <label for="view_checkbox_obsaga">Общежитие</label>
                            </div>
                            <div class="checkbox checkbox-custom col-sm-6">
                                <input id="view_benefits" name="view_benefits"
                                       type="checkbox" <?php if ($request->get('view_benefits')): ?> checked<?php endif ?><?php if (Reagordi::$app->context->server->getRequestMethod() != 'POST'): ?> checked<?php endif ?>>
                                <label for="view_benefits">Льготы</label>
                            </div>
                            <div class="checkbox checkbox-custom col-sm-6">
                                <input id="view_foreign_language" name="view_foreign_language"
                                       type="checkbox" <?php if ($request->get('view_foreign_language')): ?> checked<?php endif ?><?php if (Reagordi::$app->context->server->getRequestMethod() != 'POST'): ?> checked<?php endif ?>>
                                <label for="view_foreign_language">Иностранный язык</label>
                            </div>
                            <div class="checkbox checkbox-custom col-sm-12">
                                <input id="view_entrant_status" name="view_entrant_status"
                                       type="checkbox" <?php if ($request->get('view_entrant_status')): ?> checked<?php endif ?><?php if (Reagordi::$app->context->server->getRequestMethod() != 'POST'): ?> checked<?php endif ?>>
                                <label for="view_entrant_status">Статус заявления</label>
                            </div>
                            <br/><br/><br/><br/><br/>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-default waves-effect">Сформировать список</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-box table-responsive">
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>ФИО</th>
                    <?php if (Reagordi::$app->context->server->getRequestMethod() != 'POST' || $request->get('view_type_doc_edu')): ?>
                        <th>Аттестат</th><?php endif ?>
                    <?php if (Reagordi::$app->context->server->getRequestMethod() != 'POST' || $request->get('view_average_score')): ?>
                        <th>Средний бал</th><?php endif ?>
                    <?php if (Reagordi::$app->context->server->getRequestMethod() != 'POST' || $request->get('view_specialtie1')): ?>
                        <th>Специальность</th><?php endif ?>
                    <?php if (Reagordi::$app->context->server->getRequestMethod() != 'POST' || $request->get('view_checkbox_obsaga')): ?>
                        <th>Общежитие</th><?php endif ?>
                    <?php if (Reagordi::$app->context->server->getRequestMethod() != 'POST' || $request->get('view_benefits')): ?>
                        <th>Льготы</th><?php endif ?>
                    <?php if (Reagordi::$app->context->server->getRequestMethod() != 'POST' || $request->get('view_foreign_language')): ?>
                        <th>Иностранный язык</th><?php endif ?>
                    <?php if (Reagordi::$app->context->server->getRequestMethod() != 'POST' || $request->get('view_entrant_status')): ?>
                        <th>Статус заявления</th><?php endif ?>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                <?php foreach ($statement as $post): ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td>
                            <a href="<?= HOME_URL ?>/<?= Reagordi::$app->options->get('url', 'admin_path') ?>/priem/entrant/<?= $post->id ?>"><?= $post->last_name ?> <?= $post->first_name ?> <?= $post->middle_name ?></a>
                        </td>
                        <?php if (Reagordi::$app->context->server->getRequestMethod() != 'POST' || $request->get('view_type_doc_edu')): ?>
                            <td><?php if ($post->type_doc_edu == '1'): ?>9 кл.<?php else: ?>11 кл.<?php endif ?>
                            (<?php if ($post->type_certificate == '0'): ?> Копия<?php else: ?>Оригинал<?php endif ?>
                            )</td><?php endif ?>
                        <?php if (Reagordi::$app->context->server->getRequestMethod() != 'POST' || $request->get('view_average_score')): ?>
                            <td class="text-center"><?= mb_substr($post->average_score, 0, 5) ?></td><?php endif ?>
                        <?php if (Reagordi::$app->context->server->getRequestMethod() != 'POST' || $request->get('view_specialtie1')): ?>
                            <td><?= $post->specialtie1 ?></td><?php endif ?>
                        <?php if (Reagordi::$app->context->server->getRequestMethod() != 'POST' || $request->get('view_checkbox_obsaga')): ?>
                            <td class="text-center"><?php if ($post->checkbox_obsaga == '1'): ?><i
                                    class=" md-done"></i><?php endif ?></td><?php endif ?>
                        <?php if (Reagordi::$app->context->server->getRequestMethod() != 'POST' || $request->get('view_benefits')): ?>
                            <td><?= isset($benefits_status[$post->benefits]) ? $benefits_status[$post->benefits]: '' ?></td><?php endif ?>
                        <?php if (Reagordi::$app->context->server->getRequestMethod() != 'POST' || $request->get('view_foreign_language')): ?>
                            <td><?= isset($language_status[$post->foreign_language]) ? $language_status[$post->foreign_language]: '' ?></td><?php endif ?>
                        <?php if (Reagordi::$app->context->server->getRequestMethod() != 'POST' || $request->get('view_entrant_status')): ?>
                            <td>
                                <?php if ($post->entrant_status == '0'): ?>
                                    <span>Пустая</span>
                                <?php elseif ($post->entrant_status == '1'): ?>
                                    <span>Загрузка документов</span>
                                <?php elseif ($post->entrant_status == '2'): ?>
                                    <span>На обработке</span>
                                <?php elseif ($post->entrant_status == '3'): ?>
                                    <span>На изменении</span>
                                <?php elseif ($post->entrant_status == '4'): ?>
                                    <span>Завершена</span>
                                <?php endif ?>
                            </td>
                        <?php endif ?>
                    </tr>
                    <?php $i++ ?>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <script>
            function redirect_statement() {
                var a = document.getElementById('id_statement').value;
                if (a != '') {
                    document.location.href = '<?= HOME_URL ?>/<?= Reagordi::$app->options->get('url', 'admin_path') ?>/priem/entrant/' + a;
                }
            }

            window.onload = function () {
                $('#datatable').dataTable();
                TableManageButtons.init();
            };
        </script>
        <?php
        Reagordi::$app->context->view->assign('conteiner', ob_get_clean());

        return Reagordi::$app->context->view->fech();
    }
);
