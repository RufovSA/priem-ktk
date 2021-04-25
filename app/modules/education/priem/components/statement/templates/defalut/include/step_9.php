<?php
/** @var int $act */
/** @var array $list_priem */
/** @var string $page_url */
/** @var Reagordi\Framework\Base\Server $sessions */
?>
<div class="form-group">
    <label for="file-0b">Заявление поступающего</label>
    <input id="file-0b" type="file" name="uploaded_application" class="form-control file"
           data-preview-file-type="any" onchange="ep_change_input_file(this);">
</div>

<div class="form-group">
    <label for="file-1b">Документ удоставиряющий личность (паспорт)</label>
    <input id="file-1b" type="file" name="uploaded_passport" class="form-control file"
           data-preview-file-type="any" onchange="ep_change_input_file(this);">
</div>

<div class="form-group">
    <label for="file-2b">Документ об образовании</label>
    <input id="file-2b" type="file" name="uploaded_certificate" class="form-control file"
           data-preview-file-type="any" onchange="ep_change_input_file(this);">
</div>
