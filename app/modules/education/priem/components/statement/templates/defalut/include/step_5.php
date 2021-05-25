<?php
/** @var int $act */
/** @var array $list_priem */
/** @var string $page_url */
/** @var Reagordi\Framework\Base\Server $sessions */

$status = array(
  'Законный представитель',
  'Мать',
  'Отец',
  'Бабушка',
  'Дедушка',
);

$admin = isset($admin) ? $admin: false;
$user = isset($user) ? $user: null;
if (isset($entrant)) $user = $entrant;

$bdate = new DateTime(Reagordi::$app->context->session->get('bdate'));

$age = false;
$_t = date('Y', $bdate->getTimestamp());
if (date('Y') - $_t >= 18) $age = true;
unset($_t);
?>
<h3>Законный представитель</h3>
<div class="form-group col-md-12">
    <label for="parents_one_status">Статус <span class="color-red">*</span></label>
    <select id="parents_one_status" name="parents_one_status" class="ep_addres">
      <?php for ($i = 0; $i < count($status); $i++): ?>
          <option value="<?= $i ?>"<?php if (Reagordi::$app->context->session->get(
              'parents_one_status'
            ) == $i): ?> selected<?php endif ?>><?= $status[$i] ?></option>
      <?php endfor ?>
    </select>
</div>
<div class="form-group col-md-4">
    <label for="parents_one_last_name">Фамилия <span class="color-red">*</span></label>
    <input type="text" class="form-control" id="parents_one_last_name"
           name="parents_one_last_name" placeholder="Фамилия"
           value="<?= $sessions->get('parents_one_last_name') ?>" required/>
</div>
<div class="form-group col-md-4">
    <label for="parents_one_first_name">Имя <span class="color-red">*</span></label>
    <input type="text" class="form-control" id="parents_one_first_name"
           name="parents_one_first_name" placeholder="Имя"<?php if ($sessions->has(
      'parents_one_first_name'
    )): ?> value="<?= $sessions->get('parents_one_first_name') ?>"
           <?php endif ?>required/>
</div>
<div class="form-group col-md-4">
    <label for="parents_one_middle_name">Отчество</label>
    <input type="text" class="form-control" id="parents_one_middle_name"
           name="parents_one_middle_name" placeholder="Отчество"<?php if ($sessions->has(
      'parents_one_middle_name'
    )): ?> value="<?= $sessions->get('parents_one_middle_name') ?>"<?php endif ?> />
</div>
<?php if (!$age): ?>
<div class="form-group col-md-12">
    <label for="parents_one_type_doc">Документ, удостоверяющий личность <span
                class="color-red">*</span></label>
    <select id="parents_one_type_doc" name="parents_one_type_doc" class="form-control">
        <option value="1"<?php if (isset($_SESSION['parents_one_type_doc']) &&
            $_SESSION['type_doc'] == '1') { ?> selected<?php } ?>>Паспорт гражданина РФ
        </option>
        <option value="2"<?php if (isset($_SESSION['parents_one_type_doc']) &&
            $_SESSION['parents_one_type_doc'] == '2') { ?> selected<?php } ?>>Паспорт иностранного
            гражданина
        </option>
        <option value="3"<?php if (isset($_SESSION['parents_one_type_doc']) &&
            $_SESSION['parents_one_type_doc'] == '3') { ?> selected<?php } ?>>Временное убежище
        </option>
        <option value="4"<?php if (isset($_SESSION['parents_one_type_doc']) &&
            $_SESSION['parents_one_type_doc'] == '4') { ?> selected<?php } ?>>Удостоверение личности
            гражданина РФ в виде пластиковой карты
        </option>
        <option value="5"<?php if (isset($_SESSION['parents_one_type_doc']) &&
            $_SESSION['parents_one_type_doc'] == '5') { ?> selected<?php } ?>>Свидетельство о рождении
        </option>
        <option value="6"<?php if (isset($_SESSION['parents_one_type_doc']) &&
            $_SESSION['parents_one_type_doc'] == '6') { ?> selected<?php } ?>>Вид на жительство
        </option>
        <option value="7"<?php if (isset($_SESSION['parents_one_type_doc']) &&
            $_SESSION['parents_one_type_doc'] == '7') { ?> selected<?php } ?>>Временное удостоверение
            личности гражданина РФ
        </option>
        <option value="8"<?php if (isset($_SESSION['parents_one_type_doc']) &&
            $_SESSION['parents_one_type_doc'] == '8') { ?> selected<?php } ?>>Заграничный паспорт
            гражданина РФ
        </option>
    </select>
</div>
<div class="form-group col-md-6">
    <label for="parents_one_series_passport">Серия <span class="color-red">*</span></label>
    <input type="text" class="form-control bfh-phone" id="series_passport"
           name="parents_one_series_passport"<?php if (isset($_SESSION['parents_one_series_passport'])) { ?> value="<?php echo $_SESSION['parents_one_series_passport']; ?>"<?php } ?>
           placeholder="Серия" data-format="dd dd" required/>
</div>
<div class="form-group col-md-6">
    <label for="parents_one_number_passport">Номер <span class="color-red">*</span></label>
    <input type="text" class="form-control bfh-phone" id="parents_one_number_passport"
           name="parents_one_number_passport"<?php if (isset($_SESSION['parents_one_number_passport'])) { ?> value="<?php echo $_SESSION['parents_one_number_passport']; ?>"<?php } ?>
           placeholder="Номер" data-format="dddddd" required/>
</div>
<div class="form-group col-md-6">
    <label for="parents_one_division_code">Код подразделения</label>
    <input type="text" class="form-control bfh-phone" id="division_code"
           name="parents_one_division_code"<?php if (isset($_SESSION['parents_one_division_code'])) { ?> value="<?php echo $_SESSION['parents_one_division_code']; ?>"<?php } ?>
           placeholder="Код подразделения" data-format="ddd-ddd"/>
</div>
<div class="form-group col-md-6">
    <label for="parents_one_passport_date">Когда выдан <span class="color-red">*</span></label>
    <input type="date" class="form-control" id="passport_date"
           name="parents_one_passport_date"<?php if (isset($_SESSION['parents_one_passport_date'])) { ?> value="<?php echo $_SESSION['parents_one_passport_date']; ?>"<?php } ?>
           placeholder="Когда выдан" required/>
</div>
<div class="form-group col-md-12">
    <label for="parents_one_passport_whom">Кем выдан</label>
    <input type="text" class="form-control" id="parents_one_passport_whom"
           name="parents_one_passport_whom"<?php if (isset($_SESSION['parents_one_passport_whom'])) { ?> value="<?php echo $_SESSION['parents_one_passport_whom']; ?>"<?php } ?>
           placeholder="Кем выдан"/>
</div>
<?php endif ?>
<div class="form-group col-md-4">
    <label for="parents_one_phone">Номер телефона <span class="color-red">*</span></label>
    <input type="tel" class="form-control bfh-phone" id="parents_one_phone"
           name="parents_one_phone"<?php if (isset($_SESSION['parents_one_phone'])) { ?> value="<?php echo $_SESSION['parents_one_phone']; ?>"<?php } ?>
           placeholder="Номер телефона" data-format="+7 (ddd) ddd dd - dd" required/>
</div>
<div class="form-group col-md-8">
    <label for="parents_one_work">Место работы</label>
    <input type="text" class="form-control" id="parents_one_work" name="parents_one_work"
           placeholder="Место работы"<?php if ($sessions->has(
      'parents_one_work'
    )): ?> value="<?= $sessions->get('parents_one_work') ?>"<?php endif ?> />
</div>

<h3>Законный представитель</h3>
<div class="form-group col-md-12">
    <label for="parents_two_status">Статус</label>
    <select id="parents_two_status" name="parents_two_status" class="ep_addres">
      <?php for ($i = 0; $i < count($status); $i++): ?>
          <option value="<?= $i ?>"<?php if (Reagordi::$app->context->session->get(
              'parents_two_status'
            ) == $i): ?> selected<?php endif ?>><?= $status[$i] ?></option>
      <?php endfor ?>
    </select>
</div>
<div class="form-group col-md-4">
    <label for="parents_one_last_name">Фамилия</label>
    <input type="text" class="form-control" id="parents_two_last_name"
           name="parents_two_last_name" placeholder="Фамилия"
           value="<?= $sessions->get('parents_two_last_name') ?>"/>
</div>
<div class="form-group col-md-4">
    <label for="parents_one_first_name">Имя</label>
    <input type="text" class="form-control" id="parents_two_first_name"
           name="parents_two_first_name" placeholder="Имя"<?php if ($sessions->has(
      'parents_two_first_name'
    )): ?> value="<?= $sessions->get('parents_two_first_name') ?>"<?php endif ?> />
</div>
<div class="form-group col-md-4">
    <label for="parents_two_middle_name">Отчество</label>
    <input type="text" class="form-control" id="parents_two_middle_name"
           name="parents_two_middle_name" placeholder="Отчество"<?php if ($sessions->has(
      'parents_two_middle_name'
    )): ?> value="<?= $sessions->get('parents_two_middle_name') ?>"<?php endif ?> />
</div>
<div class="form-group col-md-4">
    <label for="parents_two_phone">Номер телефона <span class="color-red">*</span></label>
    <input type="tel" class="form-control bfh-phone" id="parents_two_phone"
           name="parents_two_phone"<?php if (isset($_SESSION['parents_two_phone'])) { ?> value="<?php echo $_SESSION['parents_two_phone']; ?>"<?php } ?>
           placeholder="Номер телефона" data-format="+7 (ddd) ddd dd - dd"/>
</div>
<div class="form-group col-md-8">
    <label for="parents_two_work">Место работы</label>
    <input type="text" class="form-control" id="parentstwo_work" name="parents_two_work"
           placeholder="Место работы"<?php if ($sessions->has(
      'parents_two_work'
    )): ?> value="<?= $sessions->get('parents_two_work') ?>"<?php endif ?> />
</div>
<?php if ($user): ?>
    <?php if ($user->comment_5): ?><p><b class="color-red">Замечания</b> <?= str_replace("\n", '<br />', $user->comment_5) ?></p><?php endif ?>
<?php endif ?>
<?php if ($admin): ?>
    <div class="form-group col-md-12">
        <label for="comment_5">Заметки</label>
        <textarea class="form-control" id="comment" name="comment_5"></textarea>
    </div>
<?php endif ?>
