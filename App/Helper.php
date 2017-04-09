<?php

namespace App;

/**
 * Class Helper
 *
 * @package App
 */
class Helper
{
    /**
     * Переводит в верхний регистр
     * первый символ каждой строки массива
     *
     * @param array $arr
     * @return array
     */
    public static function array_ucfirst(array $arr)
    {
        return array_map(function($val) {
            return ucfirst(strtolower($val));
        }, $arr);
    }
}
