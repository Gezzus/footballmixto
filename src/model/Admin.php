<?php
namespace App\Model;

class Admin extends PersistentEntity {
    public static function runQuery($context) {
        $Query = self::query($context);
        return $Query->fetchAll();
    }

    public static function getLastError() {
        return self::queryErrorInfo();
    }

}
