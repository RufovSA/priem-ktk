<?php
/** @var int $act */
/** @var array $list_priem */
/** @var string $page_url */
/** @var Reagordi\Framework\Base\Server $sessions */

$subjects = array(
  'Русский язык',
  'Литература',
  'Иностранный язык',
  'Алгебра',
  'Геометрия',
  'Информатика',
  'История',
  'Обществознание',
  'География',
  'Биология',
  'Физика',
  'Химия',
  'ОБЖ',
);
$subject_i = 1;
?>
<div class="form-group col-md-12">
    <label for="type_doc_edu">Тип документа <span class="color-red">*</span></label>
    <select id="type_doc_edu" name="type_doc_edu" class="form-control">
        <option value="1"<?php if (isset($_SESSION['type_doc_edu']) &&
          $_SESSION['type_doc_edu'] == '1') { ?> selected<?php } ?>>Аттестат (9 кл.)
        </option>
        <option value="2"<?php if (isset($_SESSION['type_doc_edu']) &&
          $_SESSION['type_doc_edu'] == '2') { ?> selected<?php } ?>>Аттестат (11 кл.)
        </option>
    </select>
</div>
<div class="form-group col-md-6">
    <label for="edu_series_num">Серия и номер документа <span
                class="color-red">*</span></label>
    <input type="number" class="form-control bfh-phone" id="edu_series_num"
           name="edu_series_num"<?php if (isset($_SESSION['edu_series_num'])) { ?> value="<?php echo $_SESSION['edu_series_num']; ?>"<?php } ?>
           placeholder="Серия и номер документа" required/>
</div>
<div class="form-group col-md-6">
    <label for="year_edu">Год окончания <span class="color-red">*</span></label>
    <select class="form-control ep_addres" name="year_edu">
      <?php for ($i = date('Y'); $i >= date('Y') - 100; $i--): ?>
          <option value="<?= $i ?>"<?php if (Reagordi::$app->context->session->get(
              'year_edu'
            ) == $i): ?> selected<?php endif ?>><?= $i ?></option>
      <?php endfor ?>
    </select>
</div>
<div class="form-group col-md-12">
    <label for="name_edu">Город и наименование образовательной организации <span
                class="color-red">*</span></label>
    <textarea class="form-control" id="name_edu" name="name_edu"
              placeholder="Наименование и город образовательной организации"
              style="min-width:100%;max-width:100%;min-height:100px"
              required><?php if (isset($_SESSION['name_edu'])) { ?><?php echo $_SESSION['name_edu']; ?><?php } ?></textarea>
</div>
<div class="form-group col-md-12">
    <input type="checkbox" id="checkbox_obraz_one" name="checkbox_obraz_one" value="1" <?php if (Reagordi::$app->context->session->has('checkbox_obraz_one')): ?> checked<?php endif ?>/>
    <label for="checkbox_obraz_one">Среднее профессиональное образование получаю впервые</label>
</div>
<div class="form-group col-md-12">
    <label>Оценки<span class="color-red">*</span>:</label>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Название</th>
            <th>Оценка</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach ($subjects as $subject): ?>
            <tr>
                <th>
                    <input class="form-control" type="text"
                           name="school_subject[<?= $subject_i ?>][name]"
                           value="<?php if (isset($_SESSION['school_subject'][$subject_i]['name'])): ?><?= $_SESSION['school_subject'][$subject_i]['name'] ?><?php else: ?><?= $subject ?><?php endif ?>"
                           placeholder="Название предмета"/>
                </th>
                <th>
                    <select class="form-control"
                            name="school_subject[<?= $subject_i ?>][estimation]" required>
                        <option value="0">Выбирите оценку</option>
                      <?php for ($i =
                                   Reagordi::$app->config->get(
                                     'education',
                                     'priem',
                                     'max_estimation'
                                   ); $i >=
                                 Reagordi::$app->config->get(
                                   'education',
                                   'priem',
                                   'min_estimation'
                                 ); $i--): ?>
                          <option value="<?= $i ?>" <?php if (isset($_SESSION['school_subject'][$subject_i]['estimation']) &&
                            $_SESSION['school_subject'][$subject_i]['estimation'] ==
                            $i): ?> selected<?php endif ?>><?= $i ?></option>
                      <?php endfor ?>
                    </select>
                </th>
            </tr>
          <?php $subject_i++; ?>
        <?php endforeach ?>
        <?php for ($j = $subject_i; $j <= 20; $j++): ?>
            <tr>
                <th>
                    <input class="form-control" type="text"
                           name="school_subject[<?= $j ?>][name]"
                           value="<?php if (isset($_SESSION['school_subject'][$j]['name'])): ?><?= $_SESSION['school_subject'][$j]['name'] ?><?php endif ?>"
                           placeholder="Название предмета"/>
                </th>
                <th>
                    <select class="form-control"
                            name="school_subject[<?= $j ?>][estimation]">
                        <option value="0">Выбирите оценку</option>
                      <?php for ($i =
                                   Reagordi::$app->config->get(
                                     'education',
                                     'priem',
                                     'max_estimation'
                                   ); $i >=
                                 Reagordi::$app->config->get(
                                   'education',
                                   'priem',
                                   'min_estimation'
                                 ); $i--): ?>
                          <option value="<?= $i ?>" <?php if (isset($_SESSION['school_subject'][$j]['estimation']) &&
                            $_SESSION['school_subject'][$j]['estimation'] ==
                            $i): ?> selected<?php endif ?>><?= $i ?></option>
                      <?php endfor ?>
                    </select>
                </th>
            </tr>
        <?php endfor ?>
        </tbody>
    </table>
</div>

