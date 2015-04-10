<?php

class Tools
{
    public static function assertCondition($condition) {
        echo ($condition ? 'OK' : 'FAIL') . '<br/>';
    }

    public static function printMessage($message) {
        echo $message . '<br/>';
    }

    public static function printArray($list) {
        $count = count($list);
        for ($idx = 0; $idx < $count; $idx++) {
            echo $list[$idx] . ',';
        }
        echo '<br/>';
    }
}