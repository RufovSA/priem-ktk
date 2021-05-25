<?php
/** @var int $act */
/** @var array $list_priem */
/** @var string $page_url */
/** @var Reagordi\Framework\Base\Server $sessions */

$admin = isset($admin) ? $admin: false;
$user = isset($user) ? $user: null;
if (isset($entrant)) $user = $entrant;

$specialties = Reagordi::$app->config->get('education', 'priem', 'specialties');
?>

<div class="form-group col-md-12">
    <label for="specialtie1">Специальность <span class="color-red">*</span></label>
    <select id="specialtie1" name="specialtie1" class="ep_addres"
            <?php if (!$admin): ?>onchange="update_date();"<?php endif ?> required>
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
            <?php if (!$admin): ?>onchange="update_date();"<?php endif ?>>
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
            <?php if (!$admin): ?>onchange="update_date();"<?php endif ?>>
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
<?php if ($user): ?>
    <?php if ($user->comment_6): ?><p><b class="color-red">Замечания</b> <?= str_replace("\n", '<br />', $user->comment_6) ?></p><?php endif ?>
<?php endif ?>
<?php if ($admin): ?>
    <div class="form-group col-md-12">
        <label for="comment_6">Заметки</label>
        <textarea class="form-control" id="comment" name="comment_6"></textarea>
    </div>
<?php endif ?>
