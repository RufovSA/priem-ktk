<?php
/** @var int $act */
/** @var array $list_priem */
/** @var string $page_url */
/** @var Reagordi\Framework\Base\Server $sessions */
?>
<div class="form-group col-md-12">
    <label for="type_doc">Документ, удостоверяющий личность <span
                class="color-red">*</span></label>
    <select id="type_doc" name="type_doc" class="form-control">
        <option value="1"<?php if (isset($_SESSION['type_doc']) &&
          $_SESSION['type_doc'] == '1') { ?> selected<?php } ?>>Паспорт гражданина РФ
        </option>
        <option value="2"<?php if (isset($_SESSION['type_doc']) &&
          $_SESSION['type_doc'] == '2') { ?> selected<?php } ?>>Паспорт иностранного
            гражданина
        </option>
        <option value="3"<?php if (isset($_SESSION['type_doc']) &&
          $_SESSION['type_doc'] == '3') { ?> selected<?php } ?>>Временное убежище
        </option>
        <option value="4"<?php if (isset($_SESSION['type_doc']) &&
          $_SESSION['type_doc'] == '4') { ?> selected<?php } ?>>Удостоверение личности
            гражданина РФ в виде пластиковой карты
        </option>
        <option value="5"<?php if (isset($_SESSION['type_doc']) &&
          $_SESSION['type_doc'] == '5') { ?> selected<?php } ?>>Свидетельство о рождении
        </option>
        <option value="6"<?php if (isset($_SESSION['type_doc']) &&
          $_SESSION['type_doc'] == '6') { ?> selected<?php } ?>>Вид на жительство
        </option>
        <option value="7"<?php if (isset($_SESSION['type_doc']) &&
          $_SESSION['type_doc'] == '7') { ?> selected<?php } ?>>Временное удостоверение
            личности гражданина РФ
        </option>
        <option value="8"<?php if (isset($_SESSION['type_doc']) &&
          $_SESSION['type_doc'] == '8') { ?> selected<?php } ?>>Заграничный паспорт
            гражданина РФ
        </option>
    </select>
</div>
<div class="form-group col-md-6">
    <label for="series_passport">Серия <span class="color-red">*</span></label>
    <input type="text" class="form-control bfh-phone" id="series_passport"
           name="series_passport"<?php if (isset($_SESSION['series_passport'])) { ?> value="<?php echo $_SESSION['series_passport']; ?>"<?php } ?>
           placeholder="Серия" data-format="dd dd" required/>
</div>
<div class="form-group col-md-6">
    <label for="number_passport">Номер <span class="color-red">*</span></label>
    <input type="text" class="form-control bfh-phone" id="number_passport"
           name="number_passport"<?php if (isset($_SESSION['number_passport'])) { ?> value="<?php echo $_SESSION['number_passport']; ?>"<?php } ?>
           placeholder="Номер" data-format="dddddd" required/>
</div>
<div class="form-group col-md-6">
    <label for="division_code">Код подразделения</label>
    <input type="text" class="form-control bfh-phone" id="division_code"
           name="division_code"<?php if (isset($_SESSION['division_code'])) { ?> value="<?php echo $_SESSION['division_code']; ?>"<?php } ?>
           placeholder="Код подразделения" data-format="ddd-ddd"/>
</div>
<div class="form-group col-md-6">
    <label for="passport_date">Когда выдан <span class="color-red">*</span></label>
    <input type="date" class="form-control" id="passport_date"
           name="passport_date"<?php if (isset($_SESSION['passport_date'])) { ?> value="<?php echo $_SESSION['passport_date']; ?>"<?php } ?>
           placeholder="Когда выдан" required/>
</div>
<div class="form-group col-md-12">
    <label for="passport_whom">Кем выдан</label>
    <input type="text" class="form-control" id="passport_whom"
           name="passport_whom"<?php if (isset($_SESSION['passport_whom'])) { ?> value="<?php echo $_SESSION['passport_whom']; ?>"<?php } ?>
           placeholder="Кем выдан"/>
</div>
