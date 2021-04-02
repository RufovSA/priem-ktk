<?php
/** @var int $act */
/** @var array $list_priem */
/** @var string $page_url */
/** @var Reagordi\Framework\Base\Server $sessions */
?>
<div class="form-group col-md-4">
    <label for="last_name">Фамилия <span class="color-red">*</span></label>
    <input type="text" class="form-control" id="last_name" name="last_name"
           placeholder="Фамилия" value="<?= $sessions->get('last_name') ?>" required/>
</div>
<div class="form-group col-md-4">
    <label for="first_name">Имя <span class="color-red">*</span></label>
    <input type="text" class="form-control" id="first_name" name="first_name"
           placeholder="Имя"<?php if ($sessions->has(
        'first_name'
    )): ?> value="<?= $sessions->get('first_name') ?>"<?php endif ?> required/>
</div>
<div class="form-group col-md-4">
    <label for="middle_name">Отчество</label>
    <input type="text" class="form-control" id="middle_name" name="middle_name"
           placeholder="Отчество"<?php if ($sessions->has(
        'middle_name'
    )): ?> value="<?= $sessions->get('middle_name') ?>"<?php endif ?> />
</div>
<div class="form-group col-md-4">
    <label for="sex">Пол <span class="color-red">*</span></label>
    <select id="sex" class="form-control" name="sex">
        <option value="1" <?php if ($sessions->get('sex') == '1'): ?> selected<?php endif ?>>Мужской</option>
        <option value="2" <?php if ($sessions->get('sex') == '2'): ?> selected<?php endif ?>>Женский</option>
    </select>
</div>
<div class="form-group col-md-4">
    <label for="place_birth">Место рождения <span class="color-red">*</span></label>
    <input type="text" class="form-control" id="place_birth" name="place_birth"
           placeholder="Место рождения"<?php if ($sessions->has(
        'place_birth'
    )): ?> value="<?= $sessions->get('place_birth') ?>"<?php endif ?> required/>
</div>
<div class="form-group col-md-4">
    <label for="bdate">Дата рождения <span class="color-red">*</span></label>
    <input type="date" class="form-control" id="bdate" name="bdate"
           placeholder="Дата рождения"<?php if ($sessions->has(
        'bdate'
    )): ?> value="<?= $sessions->get('bdate') ?>"<?php endif ?> required/>
</div>
<div class="form-group col-md-4">
    <label for="citizenship">Гражданство <span class="color-red">*</span></label>
    <select id="citizenship" name="citizenship" class="form-control">
        <option value="1"<?php if (isset($_SESSION['citizenship']) &&
            $_SESSION['citizenship'] == '1') { ?> selected<?php } ?>>Гражданин РФ
        </option>
        <option value="2"<?php if (isset($_SESSION['citizenship']) &&
            $_SESSION['citizenship'] == '2') { ?> selected<?php } ?>>Гражданин РФ и
            иностранного государства (двойное гражданство)
        </option>
        <option value="3"<?php if (isset($_SESSION['citizenship']) &&
            $_SESSION['citizenship'] == '3') { ?> selected<?php } ?>>Иностранный гражданин
        </option>
        <option value="4"<?php if (isset($_SESSION['citizenship']) &&
            $_SESSION['citizenship'] == '4') { ?> selected<?php } ?>>Лицо без гражданства
        </option>
    </select>
</div>
<div class="form-group col-md-4">
    <label for="phone">Номер телефона <span class="color-red">*</span></label>
    <input type="tel" class="form-control bfh-phone" id="phone"
           name="phone"<?php if (isset($_SESSION['phone'])) { ?> value="<?php echo $_SESSION['phone']; ?>"<?php } ?>
           placeholder="Номер телефона" data-format="+7 (ddd) ddd dd - dd" required/>
</div>
<div class="form-group col-md-4">
    <label for="email">E-Mail <span class="color-red">*</span></label>
    <input type="email" class="form-control" id="email"
           name="email"<?php if (isset($_SESSION['email'])) { ?> value="<?php echo $_SESSION['email']; ?>"<?php } ?>
           placeholder="E-Mail" required/>
</div>

<div class="form-group col-md-6">
    <label for="password">Пароль <span class="color-red">*</span></label>
    <input type="password" class="form-control" id="password" name="password"
           placeholder="Пароль" required/>
</div>
<div class="form-group col-md-6">
    <label for="password2">Повторите пароль <span class="color-red">*</span></label>
    <input type="password" class="form-control" id="password2" name="password2"
           placeholder="Повторите пароль" required/>
</div>