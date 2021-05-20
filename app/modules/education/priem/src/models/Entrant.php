<?php
/**
 * Reagordi Framework
 *
 * @package reagordi
 * @author Sergej Rufov <support@freeun.ru>
 */

namespace Reagordi\Education\Models;

use Reagordi;
use RedBeanPHP\R;
use RedBeanPHP\SimpleModel;

class Entrant extends SimpleModel
{
    public static function addEntrant($data, $id = null)
    {
        if ($id) {
            $entrant = R::load(DB_PREF . 'entrant', $id);
        } else {
            $entrant = R::xdispense(DB_PREF . 'entrant');
        }

        foreach ($data as $k => $v) {
            $entrant->$k = $v;
        }

        return R::store($entrant);
    }

    public static function isEmail($email)
    {
        $data = R::findOne(DB_PREF . 'entrant', ' `email` = ?', [$email]);

        if ($data) return true;

        return false;
    }

    public static function isPhone($phone)
    {
        $data = R::findOne(DB_PREF . 'entrant', ' `phone` = ?', [$phone]);

        if ($data) return true;

        return false;
    }

    public static function getList($where = null, $params = [])
    {
        return R::find(DB_PREF . 'entrant', $where, $params);
    }

    public static function get($id)
    {
        return R::load(DB_PREF . 'entrant', $id);
    }

    public static function countSpecialization($class, $specialization, $type_certificate)
    {
        return R::getCell(
            'SELECT COUNT(`id`) FROM `' . DB_PREF . 'entrant` WHERE `type_doc_edu` = ? AND `specialtie1` = ? AND `type_certificate` = ? AND `entrant_status` = ?',
            [$class, $specialization, $type_certificate, '4']
        );
    }

    public static function getUser($phone, $password)
    {
        $user = R::findOne(DB_PREF . 'entrant', '`phone` = ?', [$phone]);
        if ($user && Reagordi::$app->security->validatePassword($password, $user->password)) return $user;
        return null;
    }
}
