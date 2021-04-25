<?php
/**
 * Проветка "Скан-копии документов"
 *
 * @package reagorid/education/priem
 * @author Sergej Rufov <support@freeun.ru>
 */

use Verot\Upload\Upload;

echo '<pre>';
print_r($_FILES);
print_r($_POST);
echo '</pre>';
if (
    isset($_FILES['uploaded_application']) &&
    isset($_FILES['uploaded_certificate']) &&
    isset($_FILES['uploaded_passport']) &&
    $_FILES['uploaded_application']['type'] == 'application/pdf' &&
    $_FILES['uploaded_certificate']['type'] == 'application/pdf' &&
    $_FILES['uploaded_passport']['type'] == 'application/pdf'
) {
    Reagordi\Framework\IO\Directory::createDirectory(DATA_DIR . '/education/reception/' . Reagordi::$app->context->session->get('user_id') . '/');

    $upload = new Upload($_FILES['uploaded_application']);
    if ($upload->uploaded) {
        // преобразования с файлом, все возможности в ссылке ниже
        $upload->file_new_name_body = 'application';
        $upload->process(DATA_DIR . '/education/reception/' . Reagordi::$app->context->session->get('user_id') . '/'); // дирекстория для загрузки
        if ($upload->processed) {
            $upload->clean();
        } else {
            $error[] = $upload->error; // вывод ошибок (рускоязычный файл ошибок доступен на сайте)
        }
    }

    $upload = new Upload($_FILES['uploaded_certificate']);
    if ($upload->uploaded) {
        // преобразования с файлом, все возможности в ссылке ниже
        $upload->file_new_name_body = 'certificate';
        $upload->process(DATA_DIR . '/education/reception/' . Reagordi::$app->context->session->get('user_id') . '/'); // дирекстория для загрузки
        if ($upload->processed) {
            $upload->clean();
        } else {
            $error[] = $upload->error; // вывод ошибок (рускоязычный файл ошибок доступен на сайте)
        }
    }

    $upload = new Upload($_FILES['uploaded_passport']);
    if ($upload->uploaded) {
        // преобразования с файлом, все возможности в ссылке ниже
        $upload->file_new_name_body = 'passport';
        $upload->process(DATA_DIR . '/education/reception/' . Reagordi::$app->context->session->get('user_id') . '/'); // дирекстория для загрузки
        if ($upload->processed) {
            $upload->clean();
        } else {
            $error[] = $upload->error; // вывод ошибок (рускоязычный файл ошибок доступен на сайте)
        }
    }

    if (!$error) {
        $key = null;
        if (Reagordi::$app->context->session->get('verify_offline') == Reagordi::$app->config->get('education', 'priem', 'key'))
            $key = Reagordi::$app->config->get('education', 'priem', 'key');
        Reagordi::$app->context->session->destroy();
        if ($key) Reagordi::$app->context->session->set('verify_offline', $key);
        header('Location: ' . HOME_URL . '/blank.html?code=1');
        exit();
    }
}
