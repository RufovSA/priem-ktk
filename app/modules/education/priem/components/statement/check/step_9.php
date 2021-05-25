<?php
/**
 * Проветка "Скан-копии документов"
 *
 * @package reagorid/education/priem
 * @author Sergej Rufov <support@freeun.ru>
 */

/** @var object $user */

use Verot\Upload\Upload;
use Reagordi\Education\Models\Entrant;

$error = [];

if (
    !is_null($user) ||
    (isset($_FILES['uploaded_application']) &&
    isset($_FILES['uploaded_certificate']) &&
    isset($_FILES['uploaded_passport']) &&
    $_FILES['uploaded_application']['type'] == 'application/pdf' &&
    $_FILES['uploaded_certificate']['type'] == 'application/pdf' &&
    $_FILES['uploaded_passport']['type'] == 'application/pdf')
) {
    Reagordi\Framework\IO\Directory::createDirectory(DATA_DIR . '/education/reception/' . Reagordi::$app->context->session->get('user_id') . '/');

    if (isset($_FILES['uploaded_application'])) {
        if (is_file(DATA_DIR . '/education/reception/' . Reagordi::$app->context->session->get('user_id') . '/application.pdf'))
            unlink(DATA_DIR . '/education/reception/' . Reagordi::$app->context->session->get('user_id') . '/application.pdf');
        $upload = new Upload($_FILES['uploaded_application']);
        if ($upload->uploaded) {
            // преобразования с файлом, все возможности в ссылке ниже
            $upload->file_new_name_body = 'application';
            $upload->process(DATA_DIR . '/education/reception/' . Reagordi::$app->context->session->get('user_id') . '/'); // дирекстория для загрузки
            if ($upload->processed) {
                $upload->clean();
                chmod(DATA_DIR . '/education/reception/' . Reagordi::$app->context->session->get('user_id') . '/application.pdf', 0644);
            } else {
                $error[] = $upload->error; // вывод ошибок (рускоязычный файл ошибок доступен на сайте)
            }
        }
    }

    if (isset($_FILES['uploaded_certificate'])) {
        if (is_file(DATA_DIR . '/education/reception/' . Reagordi::$app->context->session->get('user_id') . '/certificate.pdf'))
            unlink(DATA_DIR . '/education/reception/' . Reagordi::$app->context->session->get('user_id') . '/certificate.pdf');
        $upload = new Upload($_FILES['uploaded_certificate']);
        if ($upload->uploaded) {
            // преобразования с файлом, все возможности в ссылке ниже
            $upload->file_new_name_body = 'certificate';
            $upload->process(DATA_DIR . '/education/reception/' . Reagordi::$app->context->session->get('user_id') . '/'); // дирекстория для загрузки
            if ($upload->processed) {
                $upload->clean();
                chmod(DATA_DIR . '/education/reception/' . Reagordi::$app->context->session->get('user_id') . '/certificate.pdf', 0644);
            } else {
                $error[] = $upload->error; // вывод ошибок (рускоязычный файл ошибок доступен на сайте)
            }
        }
    }

    if (isset($_FILES['uploaded_passport'])) {
        if (is_file(DATA_DIR . '/education/reception/' . Reagordi::$app->context->session->get('user_id') . '/passport.pdf'))
            unlink(DATA_DIR . '/education/reception/' . Reagordi::$app->context->session->get('user_id') . '/passport.pdf');
        $upload = new Upload($_FILES['uploaded_passport']);
        if ($upload->uploaded) {
            // преобразования с файлом, все возможности в ссылке ниже
            $upload->file_new_name_body = 'passport';
            $upload->process(DATA_DIR . '/education/reception/' . Reagordi::$app->context->session->get('user_id') . '/'); // дирекстория для загрузки
            if ($upload->processed) {
                $upload->clean();
                chmod(DATA_DIR . '/education/reception/' . Reagordi::$app->context->session->get('user_id') . '/passport.pdf', 0644);
            } else {
                $error[] = $upload->error; // вывод ошибок (рускоязычный файл ошибок доступен на сайте)
            }
        }
    }

    if (!$error) {
        $key = null;
        if (Reagordi::$app->context->session->get('verify_offline') == Reagordi::$app->config->get('education', 'priem', 'key'))
            $key = Reagordi::$app->config->get('education', 'priem', 'key');
        $user_id = Reagordi::$app->context->session->get('user_id');
        $user_id = Entrant::addEntrant(['entrant_status' => 2, 'certificate' => 0], $user_id);

        Reagordi::$app->context->session->destroy();
        if ($key) Reagordi::$app->context->session->set('verify_offline', $key);
        header('Location: ' . HOME_URL . '/blank.html?code=1');
        exit();
    }
}
