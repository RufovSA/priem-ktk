<?php
/** @var int $act */
/** @var array $list_priem */
/** @var string $page_url */
/** @var Reagordi\Framework\Base\Server $sessions */

$admin = isset($admin) ? $admin: false;

$specialties = Reagordi::$app->config->get('education', 'priem', 'specialties');
?>

<div class="form-group col-md-12">
    <label for="specialtie1">Специальность <span class="color-red">*</span></label>
    <select id="specialtie1" name="specialtie1" class="ep_addres"
            onchange="update_date();" required>
      <?php foreach ($specialties as $specialtie): ?>
          <optgroup label="<?= $specialtie['name'] ?>">
            <?php foreach ($specialtie['value'] as $value): ?>
              <?php if (Reagordi::$app->context->session->get('type_doc_edu') ==
                $value['class']): ?>
                    <option value="<?= $value['name'] ?>"<?php if (Reagordi::$app->context->session->get(
                        'specialtie1'
                      ) ==
                      $value['name']): ?> selected<?php endif ?>><?= $value['name'] ?></option>
              <?php endif ?>
            <?php endforeach ?>
          </optgroup>
      <?php endforeach ?>
    </select>
</div>

<div class="form-group col-md-12">
    <label for="specialtie2">Дополнительная специальность</label>
    <select id="specialtie2" name="specialtie2" class="ep_addres"
            onchange="update_date();">
        <option>Выбор специальности</option>
      <?php foreach ($specialties as $specialtie): ?>
          <optgroup label="<?= $specialtie['name'] ?>">
            <?php foreach ($specialtie['value'] as $value): ?>
              <?php if (
                Reagordi::$app->context->session->get('type_doc_edu') ==
                $value['class'] &&
                Reagordi::$app->context->session->get('specialtie1') != $value['name']
              ): ?>
                    <option value="<?= $value['name'] ?>"<?php if (Reagordi::$app->context->session->get(
                        'specialtie2'
                      ) ==
                      $value['name']): ?> selected<?php endif ?>><?= $value['name'] ?></option>
              <?php endif ?>
            <?php endforeach ?>
          </optgroup>
      <?php endforeach ?>
    </select>
</div>

<div class="form-group col-md-12">
    <label for="specialtie3">Дополнительная специальность</label>
    <select id="specialtie3" name="specialtie3" class="ep_addres"
            onchange="update_date();">
        <option>Выбор специальности</option>
      <?php foreach ($specialties as $specialtie): ?>
          <optgroup label="<?= $specialtie['name'] ?>">
            <?php foreach ($specialtie['value'] as $value): ?>
              <?php if (
                Reagordi::$app->context->session->get('type_doc_edu') ==
                $value['class'] &&
                Reagordi::$app->context->session->get('specialtie1') != $value['name'] &&
                Reagordi::$app->context->session->get('specialtie2') != $value['name']
              ): ?>
                    <option value="<?= $value['name'] ?>"<?php if (Reagordi::$app->context->session->get(
                        'specialtie3'
                      ) ==
                      $value['name']): ?> selected<?php endif ?>><?= $value['name'] ?></option>
              <?php endif ?>
            <?php endforeach ?>
          </optgroup>
      <?php endforeach ?>
    </select>
</div>
