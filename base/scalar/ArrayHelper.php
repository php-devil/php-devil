<?php
/**
 * @link http://www.php-devil.ru/
 * @copyright Copyright (c) 2017 Web Wizardry
 * @license http://www.php-devil.ru/license/
 */

namespace PhpDevil\base\scalar;

class ArrayHelper
{
    public static function mergeRecursively(array $first = [], array $second = [])
    {
        foreach ($first as $k=>$v)
        {
            if (isset($second[$k])) {
                if (is_array($v) && is_array($second[$k])) {
                    $first[$k] = self::mergeRecursively($v, $second[$k]);
                } else {
                    $first[$k] = $second[$k];
                }
                unset($second[$k]);
            }
            if (!empty($second)) foreach ($second as $n=>$o){
                $first[$n] = $o;
            }
        }
        return $first;
    }
}