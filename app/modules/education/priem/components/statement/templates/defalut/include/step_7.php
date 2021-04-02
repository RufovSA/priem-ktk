<?php
/** @var int $act */
/** @var array $list_priem */
/** @var string $page_url */
/** @var Reagordi\Framework\Base\Server $sessions */

$social_status = array(
  'Инвалид',
  'Сирота',
  'Правительственные льготы',
);
?>
<div class="form-group col-md-12">
    <label for="foreign_language">Иностранный язык <span
                class="color-red">*</span></label>
    <input type="text" class="form-control" id="foreign_language" name="foreign_language"
           placeholder="Иностранный язык"
           value="<?= $sessions->get('foreign_language') ?>" required/>
</div>
<div class="form-group col-md-12">
    <label for="benefits">При поступлении имею следующие льготы</label>
    <input type="text" class="form-control" id="benefits" name="benefits"
           placeholder="При поступлении имею следующие льготы"
           value="<?= $sessions->get('benefits') ?>"/>
</div>
<div class="form-group col-md-12">
    <label for="social_status">Социальный статус</label>
    <input type="text" class="form-control" id="social_status" name="social_status"
           placeholder="Социальный статус"
           value="<?= $sessions->get('social_status') ?>"/>
</div>
<div class="form-group col-md-12">
    <label for="doc_benefits">Документы, представляющий право на льготы</label>
    <input type="text" class="form-control" id="doc_benefits" name="doc_benefits"
           placeholder="Документы, представляющий право на льготы"
           value="<?= $sessions->get('doc_benefits') ?>"/>
</div>
<div class="form-group col-md-12">
    <input type="checkbox" id="checkbox_obsaga" name="checkbox_obsaga" value="1" <?php if (Reagordi::$app->context->session->has('checkbox_obsaga')): ?> checked<?php endif ?>/>
    <label for="checkbox_obsaga">Нуждаюсь в общажитии</label>
</div>
<div class="form-group col-md-12">
    <input type="checkbox" id="checkbox_olimpiada" name="checkbox_olimpiada" value="1" <?php if (Reagordi::$app->context->session->has('checkbox_olimpiada')): ?> checked<?php endif ?>/>
    <label for="checkbox_olimpiada">Победитель всероссийских олимпиад (член
        сборной)</label>
</div>