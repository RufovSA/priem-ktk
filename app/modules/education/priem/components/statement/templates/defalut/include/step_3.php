<?php
/** @var int $act */
/** @var array $list_priem */
/** @var string $page_url */

/** @var Reagordi\Framework\Base\Server $sessions */

use Reagordi\GeoVk\Cities;
use Reagordi\GeoVk\Countries;
use Reagordi\GeoVk\Regions;

$admin = isset($admin) ? $admin: false;
$admin_new = isset($admin_new) ? $admin_new: false;

$countri_id =
  Reagordi::$app->context->session->has('addres_passport_country') ?
    Reagordi::$app->context->session->get('addres_passport_country') :
    Reagordi::$app->config->get('reagordi', 'geo_vk', 'defalut', 'countri');
$region_id =
  Reagordi::$app->context->session->has('addres_passport_region') ?
    Reagordi::$app->context->session->get('addres_passport_region') :
    Reagordi::$app->config->get('reagordi', 'geo_vk', 'defalut', 'region');

?>
<h3>Адрес постоянной прописки</h3>
<div class="form-group col-md-12">
    <input type="checkbox" id="checkbox_addres_pass_noselect"
           name="checkbox_addres_pass_noselect"
           value="1" <?php if (Reagordi::$app->context->session->has(
      'checkbox_addres_pass_noselect'
    )) { ?> checked<?php } ?> onchange="update_date();"/>
    <label for="checkbox_addres_pass_noselect">Не нашел свой адрес в адресном
        классификаторе</label>
</div>
<?php if (Reagordi::$app->context->session->has('checkbox_addres_pass_noselect')): ?>
    <div class="form-group col-md-12">
        <label for="addres_passport_noselect">Адрес постоянной прописки<span
                    class="color-red">*</span></label>
        <textarea class="form-control" name="addres_passport_noselect"
                  placeholder="Адрес постоянной прописки"
                  required><?= Reagordi::$app->context->session->get(
            'addres_passport_noselect'
          ) ?></textarea>
    </div>
<?php else: ?>
    <div class="form-group col-md-4">
        <label for="addres_passport_country">Страна <span
                    class="color-red">*</span></label>
        <select id="addres_passport_country" name="addres_passport_country"
                class="ep_addres" onchange="update_date();">
          <?php foreach (Countries::getList() as $countri): ?>
              <option value="<?= $countri['id'] ?>"<?php if (Reagordi::$app->context->session->get(
                  'addres_passport_country'
                ) == $countri['id'] ||
                $countri['id'] ==
                Reagordi::$app->config->get(
                  'reagordi',
                  'geo_vk',
                  'defalut',
                  'countri'
                )): ?> selected<?php endif ?>><?= $countri['title'] ?></option>
          <?php endforeach ?>
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="addres_passport_region">Штат/Область/Край <span
                    class="color-red">*</span></label>
        <select id="addres_passport_region" name="addres_passport_region"
                class="ep_addres" onchange="update_date();">
          <?php foreach (Regions::getList($countri_id) as $region): ?>
              <option value="<?= $region['id'] ?>"<?php if (Reagordi::$app->context->session->get(
                  'addres_passport_region'
                ) == $region['id'] ||
                $region['id'] ==
                Reagordi::$app->config->get(
                  'reagordi',
                  'geo_vk',
                  'defalut',
                  'region'
                )): ?> selected<?php endif ?>><?= $region['title'] ?></option>
          <?php endforeach ?>
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="addres_passport_city">Город/Поселок/Село <span
                    class="color-red">*</span></label>
        <select id="addres_passport_city" name="addres_passport_city" class="ep_addres">
          <?php foreach (Cities::getList($countri_id, $region_id) as $city): ?>
              <option value="<?= $city['id'] ?>"<?php if (Reagordi::$app->context->session->get(
                  'addres_passport_city'
                ) == $city['id'] ||
                $city['id'] ==
                Reagordi::$app->config->get(
                  'reagordi',
                  'geo_vk',
                  'defalut',
                  'city'
                )): ?> selected<?php endif ?>><?php if (isset($city['area'])): ?><?= $city['area'] ?>, <?php endif ?><?= $city['title'] ?></option>
          <?php endforeach ?>
        </select>
    </div>
    <div class="form-group col-md-12">
        <label for="addres_passport_street">Улица <span class="color-red">*</span></label>
        <input type="text" id="addres_passport_street" name="addres_passport_street"
               value="<?= Reagordi::$app->context->session->get(
                 'addres_passport_street'
               ) ?>" class="form-control" required/>
    </div>
    <div class="form-group col-md-4">
        <label for="addres_passport_house">Дом <span class="color-red">*</span></label>
        <input type="text" id="addres_passport_house" name="addres_passport_house"
               value="<?= Reagordi::$app->context->session->get(
                 'addres_passport_house'
               ) ?>" class="form-control" required/>
    </div>
    <div class="form-group col-md-4">
        <label for="addres_passport_body">Корпус</label>
        <input type="text" id="addres_passport_body" name="addres_passport_body"
               value="<?= Reagordi::$app->context->session->get(
                 'addres_passport_body'
               ) ?>" class="form-control"/>
    </div>
    <div class="form-group col-md-4">
        <label for="addres_passport_flat">Квартира</label>
        <input type="text" id="addres_passport_flat" name="addres_passport_flat"
               value="<?= Reagordi::$app->context->session->get(
                 'addres_passport_flat'
               ) ?>" class="form-control"/>
    </div>
<?php endif ?>
<div class="form-group col-md-12">
    <input type="checkbox" id="checkbox_addres_fact" name="checkbox_addres_fact"
           value="1" <?php if (Reagordi::$app->context->session->has(
      'checkbox_addres_fact'
    )) { ?> checked<?php } ?> onchange="update_date();"/>
    <label for="checkbox_addres_fact">Мой адрес проживания не совпадает с
        пропиской</label>
</div>

<div id="ep_block_addres_fact"<?php if (Reagordi::$app->context->session->has(
  'checkbox_addres_fact'
)): ?> style="display: block" <?php endif ?>>
    <h3>Адрес фактического проживания</h3>

    <div class="form-group col-md-12">
        <input type="checkbox" id="checkbox_addres_fact_noselect"
               name="checkbox_addres_fact_noselect"
               value="1" <?php if (Reagordi::$app->context->session->has(
          'checkbox_addres_fact_noselect'
        )) { ?> checked<?php } ?> onchange="update_date();"/>
        <label for="checkbox_addres_fact_noselect">Не нашел свой адрес в адресном
            классификаторе</label>
    </div>

  <?php if (Reagordi::$app->context->session->has('checkbox_addres_fact_noselect')): ?>
      <div class="form-group col-md-12">
          <label for="addres_fact_noselect">Адрес фактического проживания<span
                      class="color-red">*</span></label>
          <textarea class="form-control" name="addres_fact_noselect"
                    placeholder="Адрес фактического проживания"
                    required><?= Reagordi::$app->context->session->get(
              'addres_fact_noselect'
            ) ?></textarea>
      </div>
  <?php else: ?>
      <div class="form-group col-md-4">
          <label for="addres_fact_country">Страна <span class="color-red">*</span></label>
          <select id="addres_fact_country" name="addres_fact_country" class="ep_addres"
                  onchange="update_date();">
            <?php foreach (Countries::getList() as $countri): ?>
                <option value="<?= $countri['id'] ?>"<?php if (Reagordi::$app->context->session->get(
                    'addres_fact_country'
                  ) == $countri['id'] ||
                  $countri['id'] ==
                  Reagordi::$app->config->get(
                    'reagordi',
                    'geo_vk',
                    'defalut',
                    'countri'
                  )): ?> selected<?php endif ?>><?= $countri['title'] ?></option>
            <?php endforeach ?>
          </select>
      </div>
      <div class="form-group col-md-4">
          <label for="addres_fact_region">Штат/Область/Край <span
                      class="color-red">*</span></label>
          <select id="addres_fact_region" name="addres_fact_region" class="ep_addres"
                  onchange="update_date();">
            <?php foreach (Regions::getList($countri_id) as $region): ?>
                <option value="<?= $region['id'] ?>"<?php if (Reagordi::$app->context->session->get(
                    'addres_fact_region'
                  ) == $region['id'] ||
                  $region['id'] ==
                  Reagordi::$app->config->get(
                    'reagordi',
                    'geo_vk',
                    'defalut',
                    'region'
                  )): ?> selected<?php endif ?>><?= $region['title'] ?></option>
            <?php endforeach ?>
          </select>
      </div>
      <div class="form-group col-md-4">
          <label for="addres_fact_city">Город/Поселок/Село <span
                      class="color-red">*</span></label>
          <select id="addres_fact_city" name="addres_fact_city" class="ep_addres">
            <?php foreach (Cities::getList($countri_id, $region_id) as $city): ?>
                <option value="<?= $city['id'] ?>"<?php if (Reagordi::$app->context->session->get(
                    'addres_fact_city'
                  ) == $city['id'] ||
                  $city['id'] ==
                  Reagordi::$app->config->get(
                    'reagordi',
                    'geo_vk',
                    'defalut',
                    'city'
                  )): ?> selected<?php endif ?>><?php if (isset($city['area'])): ?><?= $city['area'] ?>, <?php endif ?><?= $city['title'] ?></option>
            <?php endforeach ?>
          </select>
      </div>
      <div class="form-group col-md-12">
          <label for="addres_fact_street">Улица <span class="color-red">*</span></label>
          <input type="text" id="addres_fact_street" name="addres_fact_street"
                 value="<?= Reagordi::$app->context->session->get(
                   'addres_fact_street'
                 ) ?>" class="form-control"/>
      </div>
      <div class="form-group col-md-4">
          <label for="addres_fact_house">Дом <span class="color-red">*</span></label>
          <input type="number" id="addres_fact_house" name="addres_fact_house"
                 value="<?= Reagordi::$app->context->session->get('addres_fact_house') ?>"
                 class="form-control"/>
      </div>
      <div class="form-group col-md-4">
          <label for="addres_fact_body">Корпус</label>
          <input type="number" id="addres_fact_body" name="addres_fact_body"
                 value="<?= Reagordi::$app->context->session->get('addres_fact_body') ?>"
                 class="form-control"/>
      </div>
      <div class="form-group col-md-4">
          <label for="addres_fact_flat">Квартира</label>
          <input type="number" id="addres_fact_flat" name="addres_fact_flat"
                 value="<?= Reagordi::$app->context->session->get('addres_fact_flat') ?>"
                 class="form-control"/>
      </div>
  <?php endif ?>
</div>
