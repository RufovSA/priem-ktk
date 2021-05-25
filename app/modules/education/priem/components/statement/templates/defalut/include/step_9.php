<?php
/** @var int $act */
/** @var array $list_priem */
/** @var string $page_url */
/** @var Reagordi\Framework\Base\Server $sessions */

$admin = isset($admin) ? $admin : false;
$user = isset($user) ? $user : null;
if (isset($entrant)) $user = $entrant;
?>
<?php if ($user->copy_status_application): ?>
    <div class="form-group">
        <label for="file-0b">Заявление поступающего</label>
        <input id="file-0b" type="file" name="uploaded_application" class="form-control file"
               data-preview-file-type="any" onchange="ep_change_input_file(this);">
    </div>
<?php endif ?>
<?php if ($user->copy_status_passport): ?>
    <div class="form-group">
        <label for="file-1b">Документ, удостоверяющий личность (паспорт)</label>
        <input id="file-1b" type="file" name="uploaded_passport" class="form-control file"
               data-preview-file-type="any" onchange="ep_change_input_file(this);">
    </div>
<?php endif ?>
<?php if ($user->copy_status_certificate): ?>
    <div class="form-group">
        <label for="file-2b">Документ об образовании</label>
        <input id="file-2b" type="file" name="uploaded_certificate" class="form-control file"
               data-preview-file-type="any" onchange="ep_change_input_file(this);">
    </div>
<?php endif ?>
<?php if ($user): ?>
    <?php if ($user->comment_9): ?><p>
        <b class="color-red">Замечания</b> <?= str_replace("\n", '<br />', $user->comment_9) ?></p><br /><?php endif ?>
<?php endif ?>