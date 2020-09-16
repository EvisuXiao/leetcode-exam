<?php
/**
 * Some common helper functions
 * Created by PhpStorm.
 * User: Evisu Xiao
 * Date: 2020-09-12
 * Time: 21:30
 */
/**
 * Print the value
 * Then exit
 * @param mixed $val
 */
function dd(...$val) {
    foreach($val as $v) {
        var_dump($v);
    }
    die;
}