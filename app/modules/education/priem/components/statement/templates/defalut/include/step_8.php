<?php
/** @var int $act */
/** @var array $list_priem */
/** @var string $page_url */
/** @var Reagordi\Framework\Base\Server $sessions */

$admin = isset($admin) ? $admin: false;
?>
<p>
    <a href="<?= HOME_URL ?>/priem/statement.pdf" target="_blank">
        <span>Заявление поступающего</span>
        <span>(1 Мб)</span>
        <span style="float: right"><?= date('d.m.Y H:i') ?></span>
    </a>
</p>
<br/>
<p class="color-red">Внимание! Пожалуйста проверьте внимательно все введённые данные. На
    следующем шаге их изменить будет невозможно</p>
<br/>
