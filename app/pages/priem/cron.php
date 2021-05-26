<?php
/**
 * Reagordi CMS Generator
 *
 * @package reagordi/cms
 * @subpackage generate-page
 * @copyright Reagordi (c) 2020
 * @create-date 01.02.2021 10:53:12
 */

use Reagordi\Education\Models\Entrant;
use RedBeanPHP\R;

/** @var $collector Phroute\Phroute\RouteCollector */

$collector->get('priem/cron.html', function () {
    Reagordi::getInstance()->getApplication()->dbInit();

    $key = Reagordi::$app->context->request->get('key');

    if ($key != Reagordi::$app->config->get('education', 'priem', 'key')) {
        return 'error';
    }

    // R::find(DB_PREF . 'entrant', '`type_doc_edu` = ? AND `specialtie1` = ? AND `type_certificate` = ? ORDER BY `average_score` DESC', [$user->type_doc_edu, $user->specialtie1, '1']);

    foreach (Reagordi::$app->config->get('education', 'priem', 'specialties') as $faculty) {
        foreach ($faculty['value'] as $specialization) {
            $data = R::find(DB_PREF . 'entrant', '`type_doc_edu` = ? AND `specialtie1` = ? AND `type_certificate` = ? AND `entrant_status` = ? ORDER BY `average_score` DESC', [$specialization['class'], $specialization['name'], '1', '4']);
            $new_data = [];
            foreach ($data as $d) {
                $new_data[] = [
                    'id' => $d->id,
                    'average_score' => $d->average_score,
                ];
            }
            Reagordi\Framework\IO\Directory::createDirectory(DATA_DIR . '/education/specialties/');
            file_put_contents(DATA_DIR . '/education/specialties/' . md5($specialization['name'] . $specialization['class']) . '.tmp', json_encode($new_data));
            @chmod(DATA_DIR . '/education/specialties/' . md5($specialization['name'] . $specialization['class']) . '.tmp', 0644);
        }
    }

    return 'done';
});
